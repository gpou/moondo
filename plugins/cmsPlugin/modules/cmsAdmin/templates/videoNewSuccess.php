
<div id="sf_admin_container" class="admin_container_cms">
  <h1 class="titulo">Pàgina "<a href="<?php echo url_for('cms_admin_page_edit',$page) ?>"><?php echo $page->titre ?></a>". Vídeos</h1>
  <p><a href="<?php echo url_for('cms_admin_page_edit',$page) ?>">Tornar a la pàgina</a></p>

  <?php if ($sf_user->hasFlash('notice')): ?>
    <div class="notice"><?php echo __($sf_user->getFlash('notice'), array(), 'sf_admin') ?></div>
  <?php endif; ?>

  <?php if ($sf_user->hasFlash('error')): ?>
    <div class="error"><?php echo __($sf_user->getFlash('error'), array(), 'sf_admin') ?></div>
  <?php endif; ?>
  
  <div id="sf_admin_header"></div>

  <div id="sf_admin_content">
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
  
<form method="post" action="<?php echo url_for('cms_admin_video_create',$content) ?>">
	<input type="hidden" name="sf_method" value="put" />
	<?php echo $form->renderHiddenFields(false) ?>
	
    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>
	
	<table class="cms_admin_content_edit_<?php echo $content->type ?>">
		<tbody>
	  <?php foreach ($form as $name => $field): ?>
		<?php if ($field->isHidden()) continue ?>
			<tr>
				<th><?php echo $field->renderLabel() ?></th>
				<td>
					<?php echo $field->renderError() ?>
					<?php echo $field->render() ?>
					<?php echo $field->renderHelp() ?>
				</td>
			</tr>
	  <?php endforeach; ?>
			<tr>
				<th>&nbsp;</th>
				<td><input type="submit" value="guardar" /></td>
			</tr>
		</tbody>
	</table>

</form>

  </div>

  <div id="sf_admin_footer"></div>


</div>
