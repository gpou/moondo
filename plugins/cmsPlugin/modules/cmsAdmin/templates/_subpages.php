						<?php foreach($page->SubPages as $subpage): ?>
							<tr class="sf_admin_row child-row<?php echo $page->id?>">
								<td><?php for($i=0;$i<$level;$i++) echo '&nbsp;&nbsp;&nbsp;&nbsp;'; ?><a href="<?php echo url_for('cms_admin_page_edit',$subpage) ?>"><?php echo $subpage->titre ?></a></td>
								<td><center><a href="<?php echo url_for('cms_admin_page_'.($subpage->visible?'offline':'online'),$subpage,true) ?>"><img src="/sfDoctrinePlugin/images/tick<?php echo $subpage->visible?'':'_off' ?>.png" /></a></center></td>
								<td>
									<ul class="sf_admin_td_actions">
										<li class="sf_admin_action_promote"><?php if ($subpage->position>1): ?><a href="<?php echo url_for('cms_admin_page_promote',$subpage) ?>"> </a><?php endif ?></li>
										<li class="sf_admin_action_label"><?php echo $subpage->position ?></li>
										<li class="sf_admin_action_demote"><?php if ($subpage->position<count($page->SubPages)): ?><a href="<?php echo url_for('cms_admin_page_demote',$subpage) ?>"> </a><?php endif ?></li>
									</ul>
								</td>
							</tr>
							<?php include_partial('cmsAdmin/subpages',array("page"=>$subpage,'level'=>$level+1)); ?>
						<?php endforeach ?>