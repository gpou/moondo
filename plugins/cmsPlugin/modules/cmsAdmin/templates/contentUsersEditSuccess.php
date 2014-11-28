
  <?php if ($sf_user->hasFlash('notice')): ?>
    <div class="notice"><?php echo __($sf_user->getFlash('notice'), array(), 'sf_admin') ?></div>
  <?php endif; ?>

  <?php if ($sf_user->hasFlash('error')): ?>
    <div class="error"><?php echo __($sf_user->getFlash('error'), array(), 'sf_admin') ?></div>
  <?php endif; ?>
  
<form class="ajax_form" method="post" action="<?php echo url_for('cms_admin_content_users_update',$content) ?>" onsubmit="return sendAjax(true)">
	<input type="hidden" name="sf_method" value="put" />
	<?php echo $form->renderHiddenFields(false) ?>
	
    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>
	
	
	  <?php foreach ($form as $name => $field): ?>
		<?php if ($field->isHidden()) continue ?>
			<?php echo $field->renderError() ?>
			<?php echo $field->render() ?>
	  <?php endforeach; ?>

	<p>
		<input type="submit" class="ajax_button" value="guardar" onclick="return sendAjax(true)" />
		<input type="button" class="ajax_button" value="cancelar" onclick="return cancelAjax('<?php echo url_for('cms_admin_content_users',$content) ?>', true)" />
	</p>
</form>
