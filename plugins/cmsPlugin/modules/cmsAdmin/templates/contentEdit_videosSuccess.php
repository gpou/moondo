
  <?php if ($sf_user->hasFlash('notice')): ?>
    <div class="notice"><?php echo __($sf_user->getFlash('notice'), array(), 'sf_admin') ?></div>
  <?php endif; ?>

  <?php if ($sf_user->hasFlash('error')): ?>
    <div class="error"><?php echo __($sf_user->getFlash('error'), array(), 'sf_admin') ?></div>
  <?php endif; ?>
  
  
<form method="post" class="ajax_form" action="<?php echo url_for('cms_admin_content_update',$content) ?>" onsubmit="return sendAjax()">
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
				</td>
			</tr>
	  <?php endforeach; ?>
			<tr>
				<th>&nbsp;</th>
				<td><input type="submit" value="guardar el text" onclick="return sendAjax()" /><input type="button" value="cancel·lar" onclick="return cancelAjax('<?php echo url_for('cms_admin_content',$content) ?>')" /></td>
			</tr>
		</tbody>
	</table>

</form>
<h4>Vídeos</h4>
<table class="adminlist tabletab tableelements">
					<thead>
						<tr>
							<th>Posició</th>
							<th>Vídeo</th>
						</tr>
					</thead>
		<tbody>
			<?php foreach ($content->Videos as $video): ?>
			<tr>
				<td style="width:70px">
					<ul class="sf_admin_td_actions">
						<li class="sf_admin_action_promote"><?php if ($video->position>1): ?><a href="<?php echo url_for('cms_admin_video_promote',$video) ?>"> </a><?php endif ?></li>
						<li class="sf_admin_action_position"><?php echo $video->position ?></li>
						<li class="sf_admin_action_demote"><?php if ($video->position<count($content->Videos)): ?><a href="<?php echo url_for('cms_admin_video_demote',$video) ?>"> </a><?php endif ?></li>
					</ul>
				</td>
				<td>
					<ul class="sf_admin_td_actions">
						<li class="sf_admin_action_edit"><a href="<?php echo url_for('cms_admin_video_edit',$video) ?>"> </a></li>
						<li class="sf_admin_action_delete"><a href="<?php echo url_for('cms_admin_video_delete',$video) ?>" onclick="return (confirm('Segur que vols eliminar aquest vídeo?'));"> </a></li>
					</ul>
					<iframe width="490" height="390" src="http://www.youtube.com/embed/<?php echo $video->getUrl(ESC_RAW) ?>" frameborder="0" allowfullscreen></iframe>
					<?php echo $video->titre ?>
				</td>
			</tr>
			<?php endforeach; ?>
			<tr><td colspan="2"><a href="<?php echo url_for('cms_admin_video_new',$content) ?>">Afegir un vídeo</a></td></tr>
		</tbody>
	</table>

