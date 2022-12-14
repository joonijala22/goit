<?php

/**
 * Comments
 *
 * The `Comments` class provides static methods to be accessed by its own
 * instances and other parts of the plugin. `Comments` instances manage the
 * comments of a specific Kirby page. This involves processing HTTP POST data
 * for creating comment previews, submitting comments, storing comments as
 * Kirby pages, reading those pages and reporting status.
 *
 * `Comments` instances provide additional convenience methods for creating
 * comments forms.
 *
 * The preferred way of creating and accessing `Comments` instances is by
 * calling `$page->comments()` where `$page` is a Kirby `Page` object.
 *
 * @package   Kirby Comments
 * @author    Florian Pircher <florian@addpixel.net>
 * @link      https://addpixel.net/kirby-comments/
 * @copyright Florian Pircher
 * @author    Jonas Marx <hallo@jonas-marx.com>
 * @link      https://jonas-marx.com/
 * @copyright Jonas Marx
 * @license   The MIT License (See LICENSE file)
 */
class Comments implements Iterator, Countable
{
	/**
	 * The default option values referenced by their name.
	 *
	 * @var mixed[string]
	 */
	private static $defaults = null;

	/**
	 * All instances created using `Comments::for_page($page)` (which is also used
	 * by `$page->comments()`) referenced by the URI of the page.
	 *
	 * @var Comments[string]
	 */
	private static $instances = array();

	/**
	 * Kirby page on which the comments are posted.
	 *
	 * @var Page
	 */
	private $page;

	/**
	 * Status of the comments. Is modified during construction of a `Comments`
	 * instance and which processing the comments using `$this->process()`.
	 *
	 * @var CommentsStatus
	 */
	private $status;

	/**
	 * Whether `$this->process()` has been invoked.
	 *
	 * @var bool
	 */
	private $has_been_processed;

	/**
	 * The index of the iterator. Used for the implementation of the `Iterator`
	 * interface.
	 *
	 * @var integer
	 */
	private $iterator_index;

	/**
	 * An array of comments on $this->page (published and unpublished).
	 * All comments managed by a `Comments` instance. Is modified during
	 * construction of a `Comments` instance and which processing the comments
	 * using `$this->process()`.
	 *
	 * @var Comment[]
	 */
	private $comments;

	/**
	 * Whether the current comment preview is valid. `false` iff no preview is
	 * requested.
	 *
	 * @var bool
	 */
	private $is_valid_preview;

	/**
	 * Configures the plugin by setting default values from Kirby???s configuration.
	 * This static method will early exit if called multiple times during a
	 * single HTTP request.
	 *
	 * @param mixed[string] $defaults
	 */
	static public function init($defaults)
	{
		// Early exit if this method has already been called during this request
		if (Comments::$defaults !== null) { return; }

		// Store default options
		Comments::$defaults = $defaults;
	}

	/**
	 * Returns a `Comments` instance for `$page`. Constructs a new instance
	 * if no instance exists for the given page, returns a reference to an
	 * existing instance otherwise. Page equality is determined based on their
	 * URI.
	 *
	 * @param Page $page
	 * @return Comments
	 * @throws Exception Throws if a comment could not be constructed based on a
	 * existing comment page.
	 */
	static public function for_page($page)
	{
		$uri = $page->uri();

		// Check for existing instance
		if (array_key_exists($uri, Comments::$instances)) {
			// Return existing instance
			return Comments::$instances[$uri];
		}

		// Construct new instance
		$new_instance = new Comments($page);
		Comments::$instances[$uri] = $new_instance;

		// Return new instance
		return $new_instance;
	}

	/**
	 * Comments constructor. ATTENTION: the use of this constructor is DEPRECATED;
	 * use `Comments::for_page($page)` or `$page->comments()` instead.
	 *
	 * @param Page $page
	 * @throws Exception Throws if a comment could not be constructed based on a
	 * existing comment page.
	 */
	function __construct($page)
	{
		$this->page = $page;
		$this->status = new CommentsStatus(0);
		$this->iterator_index = 0;
		$this->comments = array();
		$this->is_valid_preview = false;
		$this->has_been_processed = false;

		// Scan for existing comments
		$comments_page_dirname = Comments::option('pages.comments.dirname');
		$comments_page = $this->page->find($comments_page_dirname);

		// Check for existence of stored comments
		if ($comments_page != null) {
			foreach ($comments_page->children() as $comment_page) {
				$this->comments[] = Comment::form_page($comment_page);
			}
		}
	}

	//
	// Options
	//

	/**
	 * This method provides convenient access to Kirby Comments???s options. Options
	 * may be configured in Kirby???s configuration file. The default values for
	 * all options are set in `Comments::init($defaults)`. All Kirby Comments
	 * options are prefixed with `comments.`; the `$key` argument must not include
	 * this prefix.
	 *
	 * Note that this method is used throughout the whole plugin.
	 *
	 * @param string $key
	 * @return mixed|null
	 */
	public static function option($key)
	{
		$value = null;

		if (array_key_exists($key, Comments::$defaults)) {
			$value = Comments::$defaults[$key];
		}
		return kirby()->option('comments.'.$key, $value);
	}

	/**
	 * Invokes a hook and returns its return value. Returns `null` if the hook is
	 * undefined or `null`.
	 *
	 * @param string $hook_name
	 * @param mixed[] $arguments
	 * @return mixed|null
	 */
	public static function invokeHook($hook_name, $arguments) {
		$hook = Comments::option('hooks.'.$hook_name);

		if ($hook !== null) {
			return call_user_func_array($hook, $arguments);
		}

		// Handle deprecation
		if ($hook_name === 'get-content-page-title' && kirby()->option('comments.setup.page.title_key', null) !== null) {
			$title_key = kirby()->option('comments.setup.page.title_key');
			return $arguments[0]->{$title_key}();
		}
		if ($hook_name === 'get-content-page-title' && kirby()->option('comments.setup.content-page.title', null) !== null) {
			$f = kirby()->option('comments.setup.content-page.title');
			return $f($arguments[0]);
		}
		if ($hook_name === 'decide-comments-page-title' && kirby()->option('comments.pages.comments.title', null) !== null) {
			$f = kirby()->option('comments.pages.comments.title');
			return $f($arguments[0]);
		}

		return null;
	}

	//
	// Process Comment
	//

	/**
	 * Processes comments based on the HTTP POST data of the HTTP request. This
	 * involves generating preview comments, storing published comments as
	 * Kirby pages, creating comments pages, validating user data and sending
	 * email notifications.
	 *
	 * This method may be called multiple times during a single HTTP request but
	 * execute only once. On repeated calls, the current status object is
	 * returned.
	 *
	 * @return CommentsStatus
	 */
	public function process()
	{
		// Early exit of repeated calls
		if ($this->has_been_processed) { return $this->status; }
		$this->has_been_processed = true;

		// Return on error
		if ($this->status->isError()) { return $this->status; }

		$is_preview = isset($_POST[Comments::option('form.preview')]);
		$is_submit  = isset($_POST[Comments::option('form.submit')]);
		$is_send    = $is_preview || $is_submit;

		$session = kirby()->session();

		// Check whether the session ID equals the posted session ID
		if ($is_submit) {
			$session_id = $session->get(Comments::option('session.key'));
			$post_session_id = $_POST[Comments::option('form.session_id')];

			if ($session_id !== $post_session_id) {
				$this->status = new CommentsStatus(300);
				return $this->status;
			}
		}

		//
		// Session is valid
		//

		// Generate new session ID
		$license_substring = substr(kirby()->option('license'), 0, 6);
		$new_session_id = md5(uniqid('comments_session_id').$license_substring);
		$session->set(Comments::option('session.key'), $new_session_id);

		if (!$is_send) {
			// No preview request, no submission request:
			return $this->status;
		}

		// Find comments page
		$comments_page_dirname = Comments::option('pages.comments.dirname');
		$comments_page = $this->page->find($comments_page_dirname);

		// Store current time in a variable so that it is guaranteed to be the
		// exact same point in time throughout the execution of this method.
		$now = new DateTime();

		// Prepare new comment
		$new_comment = null;
		$comment_page = null;
		$new_comment_id = $this->nextCommentId();

		try {
			// Try constructing a `Comment` from the current POST data
			$new_comment = Comment::from_post($this->page, $new_comment_id, $now);
		} catch (Exception $e) {
			// Construction failed (most probably due to invalid user input)
			$this->status = new CommentsStatus($e->getCode(), $e);
			return $this->status;
		}

		// Block comment hook
		try {
			if (Comments::invokeHook('decide-block-comment', array($this, $new_comment))) {
				return $this->status;
			}
		} catch (Exception $e) {
			$this->status = new CommentsStatus($e->getCode(), $e);
			return $this->status;
		}

		if ($comments_page == null) {
			// No comment was posted on `$this->page` yet; create comments page
			try {
				kirby()->impersonate('kirby');
				$dirname = Comments::option('pages.comments.dirname');
				$template = Comments::option('pages.comments.template');
				$comments_page = $this->page->createChild([
					'slug' => $dirname,
					'template' => $template,
					'content' => [
						'title' => Comments::invokeHook('decide-comments-page-title', array($this->page)),
						'date'  => $now->format('Y-m-d H:i:s')
					]
				]);
				$comments_page->publish();
			} catch (Exception $e) {
				$this->status = new CommentsStatus(200, $e);
				return $this->status;
			}

			try {
				Comments::invokeHook('did-create-comments-page', array($this, $comments_page));
			} catch (Exception $e) {
				$this->status = new CommentsStatus($e->getCode(), $e);
				return $this->status;
			}
		}

		if ($is_submit) {
			// The comment author has submitted the comment; store it as page
			try {
				$dirname = Comments::option('pages.comment.dirname').'-'.$new_comment_id;

				if (Comments::option('pages.comment.visible')) {
					// Add index to dirname to make the comment visible
					$dirname =  $new_comment_id.'-'.$dirname;
				}

				$template = Comments::option('pages.comment.template');

				// Save main fields
				$contents = array(
					'cid'  => $new_comment_id,
					'date' => $new_comment->date('Y-m-d H:i:s'),
					'text' => $new_comment->rawMessage()
				);

				if ($new_comment->rawName() !== null) {
					$contents['name'] = $new_comment->rawName();
				}
				if ($new_comment->rawEmail() !== null) {
					$contents['email'] = $new_comment->rawEmail();
				}
				if ($new_comment->rawWebsite() !== null) {
					$contents['website'] = $new_comment->rawWebsite();
				}

				// Save comment as page
		    if ($comments_page) {
		        kirby()->impersonate('kirby');
		        $comment_page = $comments_page->createChild([
		            'slug' => $dirname,
		            'template' => $template,
		            'content' => $contents
		        ]);
		    	$comment_page->publish();
		    }
			} catch (Exception $e) {
				$this->status =  new CommentsStatus(201, $e);
				return $this->status;
			}

			//
			// Comment has been saved
			//

			// Did save comment hook
			try {
				Comments::invokeHook('did-save-comment', array($this, $new_comment, $comment_page));
			} catch (Exception $e) {
				$this->status = new CommentsStatus($e->getCode(), $e);
				return $this->status;
			}

			if (kirby()->option('rastatux.kirbycomments.email.enabled')) {
				// Send email notifications
				$email = new CommentsEmail(
					kirby()->option('rastatux.kirbycomments.email.to'),
					kirby()->option('rastatux.kirbycomments.email.subject'),
					$new_comment
				);
				$email_status = $email->send();

				if ($email_status->isError()) {
					$this->status = $email_status;
				}
			}
			go(page()->url().'#comment-'.$new_comment_id);
		}

		// Add the new comment to the list
		$this->comments[] = $new_comment;

		if ($is_preview) {
			$this->is_valid_preview = true;

			// Did preview comment hook
			try {
				Comments::invokeHook('did-preview-comment', array($this, $new_comment));
			} catch (Exception $e) {
				$this->status = new CommentsStatus($e->getCode(), $e);
				return $this->status;
			}
		}

		return $this->status;
	}

	//
	// Comments List
	//

	/**
	 * `true` iff no comment is managed by this `Comments` instance.
	 *
	 * @return bool
	 */
	public function isEmpty()
	{
		return count($this->comments) === 0;
	}

	/**
	 * Number of comments managed by this `Comments` instance.
	 *
	 * @return int
	 */
	public function count()
	{
		return count($this->comments);
	}

	//
	// Form
	//

	/**
	 * The ID of the preview comment in case of a preview; the ID of the next, as
	 * of yet unwritten, comment otherwise. IDs start at 1 and increment on a per-
	 * page basis by 1.
	 *
	 * @return integer
	 */
	public function nextCommentId()
	{
		$stored_comments = array_filter($this->comments, function ($comment) {
			return $comment->isPreview() === false;
		});

		if (count($stored_comments) > 0) {
			return $stored_comments[count($stored_comments) - 1]->id() + 1;
		}
		return 1;
	}

	/**
	 * `true` iff the user has submitted a comment and no errors occurred.
	 *
	 * @return bool
	 */
	public function isSuccessfulSubmission()
	{
		$is_success = $this->status->isSuccess();
		$is_submit = isset($_POST[Comments::option('form.submit')]);

		return $is_success && $is_submit;
	}

	/**
	 * Returns the HTML-escaped value of the HTTP POST data with the name
	 * `$name`.
	 *
	 * When a user submits a form, the page is reloaded and all fields in the
	 * form are cleared. In order to keep the text that the user has typed into
	 * the fields, you have to set the `value` attribute of all input fields to
	 * the value which was transmitted by the forms request.
	 *
	 * This method helps you in doing so by returning `$default` if the form was
	 * not submitted, or an HTML-escaped version of the value posted by the user.
	 *
	 * @param string $name HTTP POST name of the field.
	 * @param string $default Default value to be used if unset.
	 * @return string
	 */
	public function value($name, $default='')
	{
		$is_preview = isset($_POST[Comments::option('form.preview')]);
		$is_submit = isset($_POST[Comments::option('form.submit')]);

		if (($is_preview || $is_submit) && isset($_POST[$name])) {
			return htmlentities(trim($_POST[$name]));
		}
		return $default;
	}

	/**
	 * Convenience method for accessing `$this->value()` for the name field.
	 *
	 * @param string $default Default value to be used if unset.
	 * @return string
	 */
	public function nameValue($default='')
	{
		return $this->value($this->nameName(), $default);
	}

	/**
	 * Convenience method for accessing `$this->value()` for the email field.
	 *
	 * @param string $default Default value to be used if unset.
	 * @return string
	 */
	public function emailValue($default='')
	{
		return $this->value($this->emailName(), $default);
	}

	/**
	 * Convenience method for accessing `$this->value()` for the website field.
	 *
	 * @param string $default Default value to be used if unset.
	 * @return string
	 */
	public function websiteValue($default='')
	{
		return $this->value($this->websiteName(), $default);
	}

	/**
	 * Convenience method for accessing `$this->value()` for the message field.
	 *
	 * @param string $default Default value to be used if unset.
	 * @return string
	 */
	public function messageValue($default='')
	{
		return $this->value($this->messageName(), $default);
	}

	/**
	 * Convenience method for accessing `$this->value()` for the honeypot field.
	 *
	 * @param string $default Default value to be used if unset.
	 * @return string
	 */
	public function honeypotValue($default='')
	{
		return $this->value($this->honeypotName(), $default);
	}

	/**
	 * HTTP POST name of the submit button. Used as the key for the HTTP POST
	 * data and as the value of the HTML input `name` attribute.
	 *
	 * @return string
	 */
	public function submitName()
	{
		return Comments::option('form.submit');
	}

	/**
	 * HTTP POST name of the preview button. Used as the key for the HTTP POST
	 * data and as the value of the HTML input `name` attribute.
	 *
	 * @return string
	 */
	public function previewName()
	{
		return Comments::option('form.preview');
	}

	/**
	 * HTTP POST name of the name field. Used as the key for the HTTP POST data
	 * and as the value of the HTML input `name` attribute.
	 *
	 * @return string
	 */
	public function nameName()
	{
		return Comments::option('form.name');
	}

	/**
	 * HTTP POST name of the email field. Used as the key for the HTTP POST data
	 * and as the value of the HTML input `name` attribute.
	 *
	 * @return string
	 */
	public function emailName()
	{
		return Comments::option('form.email');
	}

	/**
	 * HTTP POST name of the website field. Used as the key for the HTTP POST
	 * data and as the value of the HTML input `name` attribute.
	 *
	 * @return string
	 */
	public function websiteName()
	{
		return Comments::option('form.website');
	}

	/**
	 * HTTP POST name of the message field. Used as the key for the HTTP POST
	 * data and as the value of the HTML input `name` attribute.
	 *
	 * @return string
	 */
	public function messageName()
	{
		return Comments::option('form.message');
	}

	/**
	 * HTTP POST name of the honeypot field. Used as the key for the HTTP POST
	 * data and as the value of the HTML input `name` attribute.
	 *
	 * @return string
	 */
	public function honeypotName()
	{
		return Comments::option('form.honeypot');
	}

	/**
	 * HTTP POST name of the session ID field. Used as the key for the HTTP POST
	 * data and as the value of the HTML input `name` attribute.
	 *
	 * @return string
	 */
	public function sessionIdName()
	{
		return Comments::option('form.session_id');
	}

	/**
	 * `true` iff the honeypot mechanism is enabled.
	 *
	 * @return bool
	 */
	public function isUsingHoneypot()
	{
		return Comments::option('honeypot.enabled');
	}

	/**
	 * `true` iff a comment author has to provide an email address.
	 *
	 * @return bool
	 */
	public function requiresName()
	{
		return Comments::option('form.name.required');
	}

	/**
	 * `true` iff a comment author has to provide an email address.
	 *
	 * @return bool
	 */
	public function requiresEmailAddress()
	{
		return Comments::option('form.email.required');
	}

	/**
	 * Maximum allowed number of characters in the comment???s name field.
	 *
	 * @return integer
	 */
	public function nameMaxLength()
	{
		return Comments::option('form.name.max-length');
	}

	/**
	 * Maximum allowed number of characters in the comment???s email field.
	 *
	 * @return integer
	 */
	public function emailMaxLength()
	{
		return Comments::option('form.email.max-length');
	}

	/**
	 * Maximum allowed number of characters in the comment???s website field.
	 *
	 * @return integer
	 */
	public function websiteMaxLength()
	{
		return Comments::option('form.website.max-length');
	}

	/**
	 * Maximum allowed number of characters in the comment???s message field.
	 *
	 * @return integer
	 */
	public function messageMaxLength()
	{
		return Comments::option('form.message.max-length');
	}

	/**
	 * ID of the current comments session.
	 *
	 * @return string
	 */
	public function sessionId()
	{
		$session = kirby()->session();
		return $session->get(Comments::option('session.key'));
	}

	/**
	 * `true` iff the current request is a preview and the preview is valid.
	 *
	 * @return bool
	 */
	public function isValidPreview()
	{
		return $this->is_valid_preview;
	}

	//
	// Converter
	//

	/**
	 * Returns the comments managed by this `Comments` instance sorted in
	 * chronological order.
	 *
	 * @return Comment[]
	 */
	public function toArray()
	{
		return $this->comments;
	}

	//
	// Properties
	//

	/**
	 * Kirby page on which the comments are posted.
	 *
	 * @return Page
	 */
	public function getPage()
	{
		return $this->page;
	}

	//
	// Iterator
	//

	function rewind()
	{
		$this->iterator_index = 0;
	}

	function current()
	{
		return $this->comments[$this->iterator_index];
	}

	function key()
	{
		return $this->iterator_index;
	}

	function next()
	{
		$this->iterator_index += 1;
	}

	function valid()
	{
		return isset($this->comments[$this->iterator_index]);
	}

}
