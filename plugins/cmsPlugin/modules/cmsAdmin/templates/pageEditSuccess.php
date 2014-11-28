
<div id="sf_admin_container" class="admin_container_cms">
  <h1 class="titulo">Pàgina "<?php echo $page->titre ?>"</h1>


  <?php if ($sf_user->hasFlash('notice')): ?>
    <div class="notice"><?php echo __($sf_user->getFlash('notice'), array(), 'sf_admin') ?></div>
  <?php endif; ?>

  <?php if ($sf_user->hasFlash('error')): ?>
    <div class="error"><?php echo __($sf_user->getFlash('error'), array(), 'sf_admin') ?></div>
  <?php endif; ?>
  
  <div id="sf_admin_header"></div>

  <div id="sf_admin_content">

<?php use_helper('szTab'); ?>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>


    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>
	
	
	<?php addtab('Pàgina'); ?>
<form id="page_form" method="post" action="<?php echo url_for('cms_admin_page_update',$page) ?>" enctype="multipart/form-data">
    <?php echo $form->renderHiddenFields(false) ?>
	<input type="hidden" name="sf_method" value="put" />
	<table class="tabletab">
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
				<td><input type="submit" value="guardar" /> 
					<?php if ($page->canDelete()): ?>
					<input type="button" onclick="if (confirm('Segur que vols eliminar aquesta pàgina? ATENCIÓ: també s\'eliminaran les seves pàgines filles i tots els seus continguts !!!.')) window.location.replace('<?php echo url_for('cms_admin_page_delete',$page) ?>');" value="Eliminar la pàgina" />
					<?php endif ?>
				</td>
			</tr>
		</tbody>
	</table>

	<?php end_tab(); ?>
	
	<?php addtab('Continguts'); ?>
				<table class="adminlist tabletab">
					<thead>
						<tr>
							<th>Usuaris</th>
							<th>Posició</th>
							<th>Online</th>
							<th>Tipus</th>
							<th>Contingut</th>
						</tr>
					</thead>
		<tbody>
			<?php foreach ($page->Contents as $content): ?>
			<tr>
				<td style="width:50px"><div class="ajax_div ajax_content_users"><a class="ajax_edit_content_users" href="<?php echo url_for('cms_admin_content_users_edit',$content) ?>"><?php echo $content->users ?></a></div></td>
				<td style="width:80px">
					<ul class="sf_admin_td_actions">
						<li class="sf_admin_action_promote"><?php if ($content->position>1): ?><a href="<?php echo url_for('cms_admin_content_promote',$content) ?>"> </a><?php endif ?></li>
						<li class="sf_admin_action_position"><?php echo $content->position ?></li>
						<li class="sf_admin_action_demote"><?php if ($content->position<count($page->Contents)): ?><a href="<?php echo url_for('cms_admin_content_demote',$content) ?>"> </a><?php endif ?></li>
					</ul>
				</td>
				<td style="width:40px"><center><div class="ajax_div ajax_content_online"><?php include_partial('cmsAdmin/contentOnlineOffline',array('content'=>$content)) ?></div></center></td>
				<td style="width:100px"><?php switch ($content->type) { 
					case 'text': echo 'Text'; break; 
					case 'images': echo 'Imatges'; break; 
					case 'videos': echo 'Vídeos'; break; 
					case 'audios': echo 'Audios'; break; 
					case 'links': echo 'Enllaços'; break; 
					case 'docs': echo 'Documents'; break; 
					case 'submenu': echo 'Submenu'; break;
					
					} ?></td>
				<td style="width:750px" class="cms_content_cell">
					<ul class="sf_admin_td_actions">
						<li class="sf_admin_action_edit"><a class="ajax_edit_content" href="<?php echo url_for('cms_admin_content_edit',$content) ?>"> </a></li>
						<li class="sf_admin_action_delete"><a class="ajax_delete_content" href="<?php echo url_for('cms_admin_content_delete',$content) ?>"> </a></li>
					</ul>
					<div class="ajax_div ajax_content">
						<?php include_partial('cmsAdmin/content',array('content'=>$content)) ?>
					</div>
				</td>
			</tr>
			<?php endforeach; ?>
			<tr>
				<td colspan="5">Afegir continguts: 
					<a class="ajax_new_content" href="<?php echo url_for('cms_admin_content_new',array('sf_subject'=>$page,'type'=>'text')) ?>">Text</a> | 
					<a class="ajax_new_content" href="<?php echo url_for('cms_admin_content_new',array('sf_subject'=>$page,'type'=>'images')) ?>">Imatges</a> | 
					<a class="ajax_new_content" href="<?php echo url_for('cms_admin_content_new',array('sf_subject'=>$page,'type'=>'videos')) ?>">Vídeos</a> | 
					<a class="ajax_new_content" href="<?php echo url_for('cms_admin_content_new',array('sf_subject'=>$page,'type'=>'audios')) ?>">Audios</a> | 
					<a class="ajax_new_content" href="<?php echo url_for('cms_admin_content_new',array('sf_subject'=>$page,'type'=>'docs')) ?>">Documents</a> | 
					<a class="ajax_new_content" href="<?php echo url_for('cms_admin_content_new',array('sf_subject'=>$page,'type'=>'links')) ?>">Enllaços</a> | 
					<a class="ajax_new_content" href="<?php echo url_for('cms_admin_content_new',array('sf_subject'=>$page,'type'=>'submenu')) ?>">Submenú</a>
				</td>
			</tr>
		</tbody>
	</table>
	
				<?php /*if (count($page->getSubmenu())>0 && $page->nivells_sub>0): ?>
					<h4>Llistat de sub-pàgines</h4>
						<ul style="list-style:none;margin:0;padding:0">
						<?php foreach($page->getSubmenu() as $sub): ?>
							<li>
								<p><?php echo $sub->titre ?></p>
								<?php if (count($sub->getSubmenu())>0 && $page->nivells_sub>1): ?>
									<ul>
									<?php foreach($sub->getSubmenu() as $subsub): ?>
										<li>
											<p><?php echo $subsub->titre ?></p>
											<?php if (count($subsub->getSubmenu())>0 && $page->nivells_sub>2): ?>
												<ul>
												<?php foreach($subsub->getSubmenu() as $subsubsub): ?>
													<li>
														<p><?php echo $subsubsub->titre ?></p>
													</li>
												<?php endforeach ?>
												</ul>
											<?php endif ?>
										</li>
									<?php endforeach ?>
									</ul>
								<?php endif ?>
							</li>

						<?php endforeach; ?>
						</ul>
				<?php endif*/ ?>
					
	<?php end_tab(); ?>

	<?php include_tabs(); ?>


  </div>

  <div id="sf_admin_footer"></div>


</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('.ajax_edit_content_users').click(editContentUsers);
		$('.ajax_edit_content_online').click(editContentOnline);
		$('.ajax_edit_content').click(editContent);
		$('.ajax_delete_content').click(deleteContent);
		$('.ajax_new_content').click(newContent);
	});	
	

	function checkAjaxFormOpen() {
		if ($(".ajax_form").length>0) {
			alert('Hi ha un altre formulari obert. Tanqueu-lo per poder fer altres modificacions.');
			return false;
		}
		return true;
	}
	
	function newContent() {
		if (!checkAjaxFormOpen()) return false;
		var dest = $(this).parents('tr');
		var url = $(this).attr('href');
		$('<tr class="tr_loading"><td colspan="5"><div class="ajax_loading"></div></td></tr>').insertBefore(dest);
		jQuery.ajax({
					url: url ,
					error: function(result) { dest.html('<p>error</p>'); },
					success: function(result) { 
						$('.tr_loading').remove();
						$(result).insertBefore(dest);
					},
					async: true
		});
		return false;
	}
	
	var toDelete = null;
	function deleteContent() {
		if (!confirm('Segur que vols eliminar aquest contingut?')) return false;
		var dest = $(this).parents('tr').find('.ajax_div.ajax_content');
		toDelete = $(this).parents('tr');
		var url = $(this).attr('href');
		dest.fadeOut('fast', function() {
			$(this).html('<div class="ajax_loading"></div>').fadeIn('fast',function() {
				jQuery.ajax({
					url: url ,
					error: function(result) { dest.html('<p>error</p>'); },
					success: function(result) { dest.fadeOut('fast',function() {
							$(this).html(result).fadeIn('fast'); 
							window.setTimeout(function() {
								var o = toDelete.next();
								while (o.length>0) {
									var pos = o.find('.sf_admin_action_position');
									var p = parseInt(pos.html())-1;
									pos.html(p);
									o = o.next();
								}
								if (toDelete.next().find('.ajax_new_content').length>0)
									toDelete.prev().find('.sf_admin_action_demote').html('');
								if (toDelete.prev().length==0)
									toDelete.next().find('.sf_admin_action_promote').html('');
								toDelete.remove();
							},2000);
						})
					},
					async: true
				});
			});
		});
		return false;
	}
	
	function editContent() {
		if (!checkAjaxFormOpen()) return false;
		var dest = $(this).parents('tr').find('.ajax_div.ajax_content');
		var url = $(this).attr('href');
		dest.fadeOut('fast', function() {
			$(this).html('<div class="ajax_loading"></div>').fadeIn('fast',function() {
				jQuery.ajax({
					url: url ,
					error: function(result) { dest.html('<p>error</p>'); },
					success: function(result) { dest.fadeOut('fast',function() {
							$(this).html(result).fadeIn('fast'); 
						})
					},
					async: true
				});
			});
		});
		return false;
	}
	
	function editContentUsers() {
		if (!checkAjaxFormOpen()) return false;
		var dest = $(this).parents('tr').find('.ajax_div.ajax_content_users');
		var url = $(this).attr('href');
		dest.fadeOut('fast', function() {
			$(this).html('<div class="ajax_loading"></div>').fadeIn('fast',function() {
				jQuery.ajax({
					url: url ,
					error: function(result) { dest.html('<p>error</p>'); },
					success: function(result) { dest.fadeOut('fast',function() {
							$(this).html(result).fadeIn('fast'); 
							$(this).find('.ajax_edit_content_users').click(editContentUsers);
						})
					},
					async: true
				});
			});
		});
		return false;
	}
	
	function editContentOnline() {
		var dest = $(this).parents('tr').find('.ajax_div.ajax_content_online');
		var url = $(this).attr('href');
		dest.fadeOut('fast', function() {
			$(this).html('<div class="ajax_loading"></div>').fadeIn('fast',function() {
				jQuery.ajax({
					url: url ,
					error: function(result) { dest.html('<p>error</p>'); },
					success: function(result) { dest.fadeOut('fast',function() {
							$(this).html(result).fadeIn('fast'); 
							$(this).find('.ajax_edit_content_online').click(editContentOnline);
						})
					},
					async: true
				});
			});
		});
		return false;
	}
	
	function sendAjax(isUsers, isNew) {
		var form = $(".ajax_form");
		var action = form.attr('action');
		if (!isUsers) {
			if ($('#page_content_ca_text').length>0) {
				$('#page_content_ca_text').val(CKEDITOR.instances.page_content_ca_text.getData());
				$('#page_content_es_text').val(CKEDITOR.instances.page_content_es_text.getData());
				$('#page_content_en_text').val(CKEDITOR.instances.page_content_en_text.getData());
				$('#page_content_fr_text').val(CKEDITOR.instances.page_content_fr_text.getData());
			}
		}
		var data = form.serialize();
		if (isNew) var dest = form.parents('tr');
		else var dest = form.parent();
		jQuery.ajax({
			type: 'POST',
			url: action,
			data: data,
			error: function(result) { form.parent().html('<p>error</p>'); },
			success: function(result) { 
				if (isNew) {
					if (dest.prev().length>0) {
						var href = dest.prev().find('.ajax_edit_content_users').attr('href').replace('users/edit','demote');
						dest.prev().find('.sf_admin_action_demote').html('<a href="'+href+'"> </a>');
					}
					$(result).insertBefore(dest);
					dest.prev().find('.ajax_edit_content').click(editContent);
					dest.prev().find('.ajax_delete_content').click(deleteContent);
					dest.prev().find('.ajax_new_content').click(newContent);
					dest.prev().find('.ajax_edit_content_users').click(editContentUsers);
					dest.prev().find('.ajax_edit_content_online').click(editContentOnline);
					dest.remove();
				} else {
					dest.html(result); 
					dest.find('.ajax_edit_content_users').click(editContentUsers);
					dest.find('.ajax_edit_content_online').click(editContentOnline);
				}
				removeMessages();
			},
			async: true
		});
		return false;
	}
	function cancelAjax(url, isUsers) {
		var dest = $(".ajax_form").parent();
		jQuery.ajax({
			url: url ,
			error: function(result) { dest.html('<p>error</p>'); },
			success: function(result) { 
				dest.html(result); 
				if (isUsers) {
					dest.find('.ajax_edit_content_users').click(editContentUsers);
				}
			},
			async: true
		});
		return false;
	}
	function cancelAjaxNew() {
		$(".ajax_form").parents('tr').remove();
	}
	function removeMessages(reload) {
		if (reload) location.reload();
		else {
			window.setTimeout(function() {
				$('.notice').remove();
			},1000);
		}
	}

	

</script>