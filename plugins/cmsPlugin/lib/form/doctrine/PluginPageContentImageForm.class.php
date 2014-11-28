<?php

/**
 * PluginPageContentImage form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginPageContentImageForm extends BasePageContentImageForm
{
  public function configure()
  {
	  unset($this['position']);
	  $this->widgetSchema['content_id'] = new sfWidgetFormInputHidden();

      $relUrlRoot = sfContext::getInstance()->getRequest()->getRelativeUrlRoot();
      $dir = sfConfig::get('app_path_images_petites');
      $this->widgetSchema['image_small'] = new MySfWidgetFormInputFileEditable(array(
          'file_src'  => $relUrlRoot.$dir.$this->getObject()->getImageSmall(),
          'is_image'  => true,
          'with_delete' => true,
          'edit_mode' => !$this->isNew() && $this->getObject()->getImageSmall()!="" && file_exists(sfConfig::get('sf_web_dir').$dir.$this->getObject()->getImageSmall()),
          'template'  => '%file% %input%'
        ),array('class'=>'imatge'));
      $this->widgetSchema->setLabel('image_small','Imatge petita');
      $this->validatorSchema['image_small'] = new MySfValidatorFileImage(array(
        'required'                          =>  $this->isNew(),
        'path'                              =>  sfConfig::get('sf_web_dir').$dir,
        //'exact_size_x'                      =>  150,
        //'exact_size_y'                        => 100,
        'old_src'  => $this->getObject()->getImageSmall()
        ));

      $dir = sfConfig::get('app_path_images');
      $this->widgetSchema['image'] = new MySfWidgetFormInputFileEditable(array(
          'file_src'  => $relUrlRoot.$dir.$this->getObject()->getImage(),
          'is_image'  => true,
          'with_delete' => true,
          'edit_mode' => !$this->isNew() && $this->getObject()->getImage()!="" && file_exists(sfConfig::get('sf_web_dir').$dir.$this->getObject()->getImage()),
          'template'  => '%file% %input%'
        ),array('class'=>'imatge'));
      $this->widgetSchema->setLabel('image','Imatge ampliada');
      $this->validatorSchema['image'] = new MySfValidatorFileImage(array(
        'required'                          =>  $this->isNew(),
        'path'                              =>  sfConfig::get('sf_web_dir').$dir,
        'max_size_x'                      =>  1000,
        'max_size_y'                        => 800,
        'old_src'  => $this->getObject()->getImage()
        ));
	  
	  $this->widgetSchema->setHelp('image_small','Si voleu un mosaic: Mides exactes: 150px ample ; 100px alt.<br />Si voleu imatges grans: Ample: 490px');
	  $this->widgetSchema->setHelp('image','Mides màximes: 1000px ample ; 800px alt.');
		  $this->embedI18n(array('ca', 'es', 'en', 'fr'));
		  $this->widgetSchema->setLabel('ca', 'Peu de foto Català');
		  $this->widgetSchema->setLabel('es', 'Peu de foto Castellà');
		  $this->widgetSchema->setLabel('en', 'Peu de foto Anglès');
		  $this->widgetSchema->setLabel('fr', 'Peu de foto Francès');
	  
  }
}
