<?php

/**
 * PluginPageContentDoc form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginPageContentDocForm extends BasePageContentDocForm
{
  public function configure()
  {
	  unset($this['position']);
	  $this->widgetSchema['content_id'] = new sfWidgetFormInputHidden();

      $relUrlRoot = sfContext::getInstance()->getRequest()->getRelativeUrlRoot();
      $dir = sfConfig::get('app_path_docs');
      $this->widgetSchema['url'] = new MySfWidgetFormInputFileEditable(array(
          'file_src'  => $relUrlRoot.$dir.$this->getObject()->getUrl(),
          'is_image'  => false,
          'with_delete' => true,
          'edit_mode' => !$this->isNew() && $this->getObject()->getUrl()!="" && file_exists(sfConfig::get('sf_web_dir').$dir.$this->getObject()->getUrl()),
          'template'  => '%file% %input%'
        ));
      $this->widgetSchema->setLabel('url','Document');
      $this->validatorSchema['url'] = new MySfValidatorFile(array(
        'required'                          =>  $this->isNew(),
        'path'                              =>  sfConfig::get('sf_web_dir').$dir,
        'old_src'  => $this->getObject()->getUrl()
        ));
	  
	  $this->embedI18n(array('ca', 'es', 'en', 'fr'));
	  $this->widgetSchema->setLabel('ca', 'Títol Català');
	  $this->widgetSchema->setLabel('es', 'Títol Castellà');
	  $this->widgetSchema->setLabel('en', 'Títol Anglès');
	  $this->widgetSchema->setLabel('fr', 'Títol Francès');
	  
  }
	
}
