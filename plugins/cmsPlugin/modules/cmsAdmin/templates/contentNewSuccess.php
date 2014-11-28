			<tr>
				<td style="width:50px"><?php echo $content->users ?></td>
				<td style="width:80px">&nbsp;</td>
				<td style="width:40px"><center><div class="ajax_div ajax_content_online"><img src="/sfDoctrinePlugin/images/tick.png" /></div></center></td>
				<td style="width:100px"><?php switch ($content->type) { 
					case 'text': echo 'Text'; break; 
					case 'images': echo 'Imatges'; break; 
					case 'videos': echo 'Vídeos'; break; 
					case 'audios': echo 'Audios'; break; 
					case 'links': echo 'Enllaços'; break; 
					case 'docs': echo 'Documents'; break; 
					case 'submenu': echo 'Submenú'; break; 
					
					} ?></td>
				<td class="cms_content_cell" style="width:750px">
					<div class="ajax_div ajax_content">

  <?php if ($sf_user->hasFlash('notice')): ?>
    <div class="notice"><?php echo __($sf_user->getFlash('notice'), array(), 'sf_admin') ?></div>
  <?php endif; ?>

  <?php if ($sf_user->hasFlash('error')): ?>
    <div class="error"><?php echo __($sf_user->getFlash('error'), array(), 'sf_admin') ?></div>
  <?php endif; ?>
  
	  
<form method="post" class="ajax_form" action="<?php echo url_for('cms_admin_content_create',array('sf_subject'=>$page,'type'=>$type)) ?>" onsubmit="return sendAjax(false,true)">
	<input type="hidden" name="sf_method" value="put" />
	<?php echo $form->renderHiddenFields(false) ?>
	
    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>
	
	<table>
		<tbody>
	  <?php foreach ($form as $name => $field): ?>
		<?php if ($field->isHidden()) continue ?>
			<tr>
				<th style="padding:0"><?php echo $field->renderLabel() ?></th>
				<td>
					<?php echo $field->renderError() ?>
					<?php echo $field->render() ?>
				</td>
			</tr>
	  <?php endforeach; ?>
			<?php if ($type!='text'): ?>
			<tr>
				<th></th>
				<td>Clica el botó 'crear' per poder afegir-hi elements</td>
			</tr>
			<?php endif ?>
			<tr>
				<th>&nbsp;</th>
				<td><input type="submit" value="crear" onclick="return sendAjax(false, true)" /><input type="button" value="cancel·lar" onclick="return cancelAjaxNew()" /><?php /* <a href="<?php echo url_for('cms_admin_content',$content) ?>">Cancel·lar i tornar a la pàgina</a>*/ ?></td>
			</tr>
		</tbody>
	</table>

</form>


					</div>
				</td>
			</tr>
