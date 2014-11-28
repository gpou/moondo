<?php slot('imatge','img_'.sfConfig::get('apartat').'.png'); ?>
<?php slot('submenu') ?>
<?php include_component('cms', 'submenu', array('parent'=>$page->Apartat->id,'id'=>$page->subApartat->id,'id2'=>$page->id)); ?>
<?php end_slot(); ?>

		<?php include_component('cms', 'page', array('id'=>$page->id,'showTitle'=>true,'showSubmenu'=>true)); ?>
