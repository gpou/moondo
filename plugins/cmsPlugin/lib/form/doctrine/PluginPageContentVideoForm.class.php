<?php

/**
 * PluginPageContentVideo form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginPageContentVideoForm extends BasePageContentVideoForm
{
  public function configure()
  {
	  unset($this['position'],$this['image_small']);
	  $this->widgetSchema['content_id'] = new sfWidgetFormInputHidden();
	  $this->widgetSchema['url'] = new sfWidgetFormYouTube();
	  $this->widgetSchema->setLabel('url','Vídeo de Youtube');
	  $this->embedI18n(array('ca', 'es', 'en', 'fr'));
	  $this->widgetSchema->setLabel('ca', 'Títol Català');
	  $this->widgetSchema->setLabel('es', 'Títol Castellà');
	  $this->widgetSchema->setLabel('en', 'Títol Anglès');
	  $this->widgetSchema->setLabel('fr', 'Títol Francès');
	  
  }
	
}
