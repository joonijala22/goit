<?php

/*
 * This is the example comments form snippet. Feel free to use this code as a
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
<?php if ($comments->isSuccessfulSubmission()): ?>
	<div class="thank-you"><?= t('kirbycomments.thanks_for_comment') ?>!<div class="close" onclick="$('.thank-you').fadeOut();">x</div></div>
<?php else: ?>
	<h2 id="comments-form-headline"><?= t('kirbycomments.write_your_comment') ?></h2>
	
	<?php if ($status->isUserError()): ?>
		<p id="comment-<?php echo $comments->nextCommentId() ?>" class="error">
			<?php echo $status->getMessage() ?>
		</p>
	<?php endif ?>
	
	<form action="#comment-<?php echo $comments->nextCommentId() ?>" method="post" accept-charset="utf-8" role="form" aria-labelledby="comments-form-headline">
	<fieldset>	
	<div class="margin-bottom-xs">
	<label for="comments-field-name"><?= t('kirbycomments.name') ?><?php if ($comments->requiresName()): ?><abbr title="required">*</abbr><?php endif ?></label>
		<input class="form-control width-60%" id="comments-field-name" type="text" name="<?php echo $comments->nameName() ?>" value="<?php echo $comments->nameValue() ?>" maxlength="<?php echo $comments->nameMaxLength() ?>" <?php e($comments->requiresName(), 'required') ?>>
	</div>
	
		
		<?php if ($comments->isUsingHoneypot()): ?>
			<div style="display: none" hidden>
				<input class="form-control width-60%" type="text" name="<?php echo $comments->honeypotName() ?>" value="<?php echo $comments->honeypotValue() ?>">
			</div>
		<?php endif ?>
		<div class="margin-bottom-xs">
		<label for="comments-field-message"><?= t('kirbycomments.message') ?><abbr title="required">*</abbr></label>
		<textarea class="form-control width-60%" id="comments-field-message" name="<?php echo $comments->messageName() ?>" maxlength="<?php echo $comments->messageMaxLength() ?>" required><?php echo $comments->messageValue() ?></textarea>
		</div>
		<input type="hidden" name="<?php echo $comments->sessionIdName() ?>" value="<?php echo $comments->sessionId() ?>">
		
		<input type="submit" name="<?php echo $comments->previewName() ?>" value="<?= t('kirbycomments.preview') ?>">
		<?php if ($comments->isValidPreview()): ?>
			<input id="comments-submit" type="submit" name="<?php echo $comments->submitName() ?>" value="<?= t('kirbycomments.send') ?>">
		<?php endif ?>
		</fieldset>
	</form>
<?php endif ?>
