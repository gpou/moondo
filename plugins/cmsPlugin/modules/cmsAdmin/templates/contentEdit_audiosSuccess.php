
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
	
<h4>Audios</h4>
	<table class="adminlist tabletab">
	<thead>
		<tr>
			<th>Posició</th>
			<th>Audio</th>
		</tr>
	</thead>
	<tbody>
			<?php foreach ($content->Audios as $audio): ?>
			<tr>
				<td style="width:70px">
					<ul class="sf_admin_td_actions">
						<li class="sf_admin_action_promote"><?php if ($audio->position>1): ?><a href="<?php echo url_for('cms_admin_audio_promote',$audio) ?>"> </a><?php endif ?></li>
						<li class="sf_admin_action_position"><?php echo $audio->position ?></li>
						<li class="sf_admin_action_demote"><?php if ($audio->position<count($content->Audios)): ?><a href="<?php echo url_for('cms_admin_audio_demote',$audio) ?>"> </a><?php endif ?></li>
					</ul>
				</td>
				<td>
					<ul class="sf_admin_td_actions">
						<li class="sf_admin_action_edit"><a href="<?php echo url_for('cms_admin_audio_edit',$audio) ?>"> </a></li>
						<li class="sf_admin_action_delete"><a href="<?php echo url_for('cms_admin_audio_delete',$audio) ?>" onclick="return (confirm('Segur que vols eliminar aquest audio?'));"> </a></li>
					</ul>
					<object height="81px" width="490px"><param name="movie" value="http://player.soundcloud.com/player.swf?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F<?php echo $audio->getUrl(ESC_RAW) ?>"></param> <param name="allowscriptaccess" value="always"></param><embed allowscriptaccess="always" src="http://player.soundcloud.com/player.swf?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F<?php echo $audio->getUrl(ESC_RAW) ?>" type="application/x-shockwave-flash" height="81px" width="490px"></embed> </object>
					<?php echo $audio->titre ?>
				</td>
			</tr>
			<?php endforeach; ?>
			<tr><td colspan="2"><a href="<?php echo url_for('cms_admin_audio_new',$content) ?>">Afegir un audio</a></td></tr>
	</tbody>
</table>

