<?php

/**
 * Kirby Comments
 *
 * File-based comments stored as subpages.
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

include_once('plugin/Comments.php');
include_once('plugin/Comment.php');
include_once('plugin/NestedComment.php');
include_once('plugin/CommentsEmail.php');
include_once('plugin/CommentsStatus.php');
include_once('plugin/CommentsField.php');
include_once('plugin/CommentsFieldType.php');

/*
 * Initialize Comments with default option values
 */
Comments::init(array(
	'pages.comments.dirname'           => 'comments',
	'pages.comments.template'          => 'comments',
	'pages.comment.dirname'            => 'comment',
	'pages.comment.template'           => 'comment',
	'pages.comment.visible'            => true,
	'form.submit'                      => 'submit',
	'form.preview'                     => 'preview',
	'form.name'                        => 'name',
	'form.name.required'               => true,
	'form.name.max-length'             => 64,
	'form.email'                       => 'email',
	'form.email.required'              => false,
	'form.email.max-length'            => 64,
	'form.website'                     => 'website',
	'form.website.max-length'          => 64,
	'form.message'                     => 'message',
	'form.message.max-length'          => 1024,
	'form.session_id'                  => 'session_id',
	'form.honeypot'                    => 'subject',
	'honeypot.enabled'                 => true,
	'honeypot.human-value'             => '',
	'email.undefined-value'            => '(not specified)',
	'session.key'                      => 'comments',
	'hooks.decide-block-comment'       => function () {
		return false;
	},
	'hooks.did-create-comments-page'   => null,
	'hooks.did-preview-comment'        => null,
	'hooks.did-save-comment'           => null,
	'hooks.decide-comments-page-title' => function ($page) {
		return 'Comments for “' . $page->title() . '”';
	},
	'hooks.get-content-page-title'     => function ($page) {
		return $page->title();
	}
));

/*
 * Register custom page methods, blueprints and snippets
*/
Kirby::plugin('rastatux/kirbycomments', [
	'pageMethods' => [
      'comments' => function () {
				return Comments::for_page(page());
      }
  ],
  'options'    => [
        'email.enabled'					=> false,
        'email.to'						=> array(),
        'email.subject'					=> 'New Comment on {{ page.title }}',
        'form.message.allowed_tags'		=> '<p><br><a><em><strong><code><pre><blockquote>',
        'form.message.htmlentities'		=> true,
		'form.message.smartypants'		=> true,
  ],
  'snippets' => [
    'comments-form' => __DIR__ . '/snippets/comments-form.php',
		'comments-list' => __DIR__ . '/snippets/comments-list.php',
		'comments' => __DIR__ . '/snippets/comments.php'
  ],
  'blueprints' => [
    'comments' => __DIR__ . '/blueprints/comments.yml',
		'comment' => __DIR__ . '/blueprints/comment.yml'
  ],
  'translations' => [
        'en' => [
            'kirbycomments.comments' => 'Comments',
            'kirbycomments.thanks_for_comment' => 'Thank you for your comment',
            'kirbycomments.write_your_comment' => 'Write a comment',
            'kirbycomments.name' => 'Name',
            'kirbycomments.email' => 'Email',
            'kirbycomments.website' => 'Website',
            'kirbycomments.message' => 'Message',
            'kirbycomments.preview' => 'Preview',
            'kirbycomments.posted_on' => 'Posted on',
            'kirbycomments.preview_text' => 'This is a preview of your comment. If you’re happy with it, click on',
            'kirbycomments.send' => 'Submit'
        ],
        'de' => [
            'kirbycomments.comments' => 'Kommentare',
            'kirbycomments.thanks_for_comment' => 'Danke für Dein Kommentar',
            'kirbycomments.write_your_comment' => 'Schreib ein Kommentar',
            'kirbycomments.name' => 'Name',
            'kirbycomments.email' => 'Email',
            'kirbycomments.website' => 'Website',
            'kirbycomments.message' => 'Nachricht',
            'kirbycomments.preview' => 'Vorschau',
            'kirbycomments.posted_on' => 'Geposted am',
            'kirbycomments.preview_text' => 'Das ist eine Vorschau deines Kommentars. Wenn du es so verschicken willst, klicke auf',
            'kirbycomments.send' => 'Abschicken'
        ]
    ]
]);
