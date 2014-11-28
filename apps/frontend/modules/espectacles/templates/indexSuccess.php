<?php slot('imatge','img_'.sfConfig::get('apartat').'.png'); ?>
<?php slot('submenu') ?>
<?php include_component('cms', 'submenu', array('parent'=>$page->id,'id'=>0)); ?>
<?php end_slot();  ?>

		<h2><?php if ($page->id!=45) echo $page->titre ?></h2>
		<p>&nbsp;</p>

		<?php include_component('cms', 'page', array('id'=>$page->id,'showTitle'=>false,'showSubmenu'=>true)); ?>
