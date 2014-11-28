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
					
					} ?></td>
				<td class="cms_content_cell" style="width:750px">
					<ul class="sf_admin_td_actions">
						<li class="sf_admin_action_edit"><a class="ajax_edit_content" href="<?php echo url_for('cms_admin_content_edit',$content) ?>"> </a></li>
						<li class="sf_admin_action_delete"><a class="ajax_delete_content" href="<?php echo url_for('cms_admin_content_delete',$content) ?>"> </a></li>
					</ul>
					<div class="ajax_div ajax_content">
						  <?php if ($sf_user->hasFlash('notice')): ?>
							<div class="notice"><?php echo __($sf_user->getFlash('notice'), array(), 'sf_admin') ?></div>
						  <?php endif; ?>
						<?php include_partial('cmsAdmin/content',array('content'=>$content)) ?>
					</div>
				</td>
			</tr>
