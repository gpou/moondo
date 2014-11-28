<div id="sf_admin_container">
	<h1 class="titulo"><?php echo $page->titre ?></h1>

		<div id="sf_admin_content">
		  <?php if ($sf_user->hasFlash('notice')): ?>
			<div class="notice"><?php echo __($sf_user->getFlash('notice'), array(), 'sf_admin') ?></div>
		  <?php endif; ?>

		  <?php if ($sf_user->hasFlash('error')): ?>
			<div class="error"><?php echo __($sf_user->getFlash('error'), array(), 'sf_admin') ?></div>
		  <?php endif; ?>

			<div class="sf_admin_list">
				<table class="adminlist" id="taula">
					<thead>
						<tr>
							<th>Títol</th>
							<th>Online</th>
							<th>Posició</th>
						</tr>
					</thead>
					<tbody>
						<tr class="sf_admin_row odd parent" id="row<?php echo $page->id?>">
							<td><a href="<?php echo url_for('cms_admin_page_edit',$page) ?>"><?php echo strtoupper($page->titre) ?></a></td>
							<td><?php if ($page->canEditVisible()): ?><center><a href="<?php echo url_for('cms_admin_page_'.($page->visible?'offline':'online'),$page,true) ?>"><img src="/sfDoctrinePlugin/images/tick<?php echo $page->visible?'':'_off' ?>.png" /></a></center><?php endif ?></td>
							<td></td>
						</tr>
						<?php include_partial('cmsAdmin/subpages',array("page"=>$page,'level'=>1)); ?>

					</tbody>
				</table>
			</div>
			<p><a href="<?php echo url_for('cms_admin_page_new') ?>">Afegir una pàgina</a></p>
		</div>

</div>
