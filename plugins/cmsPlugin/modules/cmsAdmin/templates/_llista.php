		<?php foreach($page->getSubmenu() as $sub): ?>
			<li>
				<?php if ($sub->image && $nivell==1): ?><img class="foto_pagina" src="<?php echo sfConfig::get('app_path_images_llistat').$sub->image ?>" alt="<?php echo $sub->titre ?>" /><?php endif ?>
				<h<?php echo $nivell+3 ?>><a href="<?php echo url_for('cms_admin_page_edit',$sub) ?>" title="<?php echo $sub->titre ?>"><?php echo $sub->titre ?></a></h4>
				<?php if (trim($sub->getText(ESC_RAW))!='') echo $sub->getText(ESC_RAW); ?>
				<?php if (count($sub->getSubmenu())>0 && $nivells>$nivell): ?>
					<ul>
						<?php include_partial('cmsAdmin/llista',array('page'=>$sub,'nivells'=>$nivells,'nivell'=>$nivell+1)); ?>
					</ul>
				<?php endif ?>
			</li>
		<?php endforeach ?>