	  
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

<h4>Documents</h4>
<table class="adminlist tabletab tableelements">
	<thead>
		<tr>
			<th>Posició</th>
			<th>Document</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($content->Docs as $doc): ?>
		<tr>
			<td style="width:70px">
				<ul class="sf_admin_td_actions">
					<li class="sf_admin_action_promote"><?php if ($doc->position>1): ?><a href="<?php echo url_for('cms_admin_doc_promote',$doc) ?>"> </a><?php endif ?></li>
					<li class="sf_admin_action_position"><?php echo $doc->position ?></li>
					<li class="sf_admin_action_demote"><?php if ($doc->position<count($content->Docs)): ?><a href="<?php echo url_for('cms_admin_doc_demote',$doc) ?>"> </a><?php endif ?></li>
				</ul>
			</td>
			<td>
				<ul class="sf_admin_td_actions">
					<li class="sf_admin_action_edit"><a href="<?php echo url_for('cms_admin_doc_edit',$doc) ?>"> </a></li>
					<li class="sf_admin_action_delete"><a href="<?php echo url_for('cms_admin_doc_delete',$doc) ?>" onclick="return (confirm('Segur que vols eliminar aquest document?'));"> </a></li>
				</ul>
				<a href="<?php echo sfConfig::get('app_path_docs').$doc->url ?>" alt="<?php echo $doc->titre ?>"><?php echo $doc->titre?$doc->titre:$doc->url ?></a>
			</td>
		</tr>
	<?php endforeach; ?>
	<tr><td colspan="2"><a href="<?php echo url_for('cms_admin_doc_new',$content) ?>">Afegir un document</a></td></tr>
	</tbody>
</table>

