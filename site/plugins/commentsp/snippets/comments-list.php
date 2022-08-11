<?php

/*
 * This is the example comments list snippet. Feel free to use this code as a
 * reference for creating your own, custom comments snippet.
 * 
 * Custom snippet markup guide:
 * <https://github.com/Addpixel/KirbyComments#custom-markup>
 * 
 * API documentation:
 * <https://github.com/Addpixel/KirbyComments#api-documentation>
 */

$comments = $page->comments();
$status = $comments->process();

?>
<?php if (!$comments->isEmpty()): ?>
  <h1 class="text-md"><?= t('kirbycomments.comments') ?></h1>
  <form aria-label="Choose sorting option">
        <div class="flex flex-wrap gap-sm text-sm">
          <div class="position-relative">
            <input class="comments__sorting-label" type="radio" name="sortComments" id="sortCommentsPopular" checked>
            <label for="sortCommentsPopular">Popular</label>
          </div>
      
          <div class="position-relative">
            <input class="comments__sorting-label" type="radio" name="sortComments" id="sortCommentsNewest">
            <label for="sortCommentsNewest">Newest</label>
          </div>
        </div>
      </form>
    </div>
  </div>
	
  <?php foreach ($comments as $comment): ?>
    <ul class="margin-bottom-lg">
    <li class="comments__comment">
      
		<article id="comment-<?php echo $comment->id() ?>" class="comment<?php e($comment->isPreview(), ' preview"') ?>">
			<h3>
				<?php e($comment->isLinkable(), '<a rel="nofollow noopener" href="'.$comment->website().'" target="_blank">') ?>
				<?php echo $comment->name() ?>
				<?php e($comment->isLinkable(), '</a>') ?>
			</h3>
			
			<aside class="comment-info">
				<?php if ($comment->isPreview()): ?>
					<p><?= t('kirbycomments.preview_text') ?> <a href="#comments-submit"><?= t('kirbycomments.send') ?></a>.</p>
				<?php else: ?>
					<p><?= t('kirbycomments.posted_on') ?> <?php echo $comment->date('Y-m-d') ?>.
						<a href="#comment-<?php echo $comment->id() ?>" title="Permalink" area-label="Permalink">#</a></p>
				<?php endif ?>
			</aside>
			
			<?= $comment->message() ?>
    </article>
        </li>
        </ul>
	<?php endforeach ?>
<?php endif ?>
