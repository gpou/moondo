<?php

/**
 * PluginPageContentLink form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginPageContentLinkForm extends BasePageContentLinkForm
{
  public function configure()
  {
	  unset($this['position']);
	  $this->widgetSchema->setLabel('url','Adreça de l\'enllaç');
	  $this->widgetSchema['content_id'] = new sfWidgetFormInputHidden();
	  $this->validatorSchema['url'] = new myValidatorUrl();
	  
	  $this->embedI18n(array('ca', 'es', 'en', 'fr'));
	  $this->widgetSchema->setLabel('ca', 'Títol Català');
	  $this->widgetSchema->setLabel('es', 'Títol Castellà');
	  $this->widgetSchema->setLabel('en', 'Títol Anglès');
	  $this->widgetSchema->setLabel('fr', 'Títol Francès');
	  
  }
	
}
