<?php

/**
 * PluginPageContent form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginPageContentForm extends BasePageContentForm
{
  public function configure()
  {
	if (!$this->getOption('users', false)) {
		unset($this['page_id'],$this['type'],$this['position'],$this['users'],$this['visible']);
	  
	  $obj = $this->getObject();
	  if ($obj->type=='submenu') {
		  $this->widgetSchema['submenu_levels'] = new sfWidgetFormChoice(array('choices' => array('1'=>'1','2'=>'2','3'=>'3')));
		  $this->widgetSchema->setLabel('submenu_levels', 'Nivells de submenú');
	  } else {
		  unset($this['submenu_levels']);
	  }
	  //if ($obj->type == 'text' || $obj->type=='docs') {
		  $this->embedI18n(array('ca', 'es', 'en', 'fr'));
		  $this->widgetSchema->setLabel('ca', 'Català');
		  $this->widgetSchema->setLabel('es', 'Castellà');
		  $this->widgetSchema->setLabel('en', 'Anglès');
		  $this->widgetSchema->setLabel('fr', 'Francès');
	  //}
	} else {
		unset($this['page_id'],$this['type'],$this['position'],$this['visible'],$this['submenu_levels']);
	}
  }
}
