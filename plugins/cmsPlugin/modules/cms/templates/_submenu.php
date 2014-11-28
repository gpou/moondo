				<ul class="submenu">
<?php foreach($page->getSubmenu() as $sub): $actiu = $id==$sub->id || $page->id==$id; ?>
					<li<?php echo $actiu?' class="actiu"':'' ?>><a href="<?php echo $sub->getUrl() ?>" title="<?php echo $sub->titre ?>"><?php echo $sub->titre ?></a>
					<?php if ($actiu && (count($sub->getSubmenu())>0)): ?>
						<ul class="submenu">
							<?php foreach($sub->getSubmenu() as $subsub): $actiusub = isset($id2) && $id2==$subsub->id; ?>
							<li<?php echo $actiusub?' class="actiu"':'' ?>><a href="<?php echo $subsub->getUrl() ?>" title="<?php echo $subsub->titre ?>"><?php echo $subsub->titre ?></a></li>
							<?php endforeach ?>
						</ul>
					<?php endif ?>
					</li>
<?php endforeach; ?>

				</ul>
