<?php

/**
 * PluginPage form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginPageForm extends BasePageForm
{
  public function configure()
  {
	  unset($this['slug'],$this['position'],$this['submenu_list_class'],$this['nivells_sub']);
	  //$this->widgetSchema['parent_id'] = new sfWidgetFormInputHidden();
	  $this->widgetSchema['visible']->setOption('label','Online');
	  //$this->widgetSchema['nivells_sub'] = new sfWidgetFormChoice(array('choices' => array('0'=>'0','1'=>'1','2'=>'2','3'=>'3')));
	  //$this->widgetSchema['nivells_sub']->setOption('label','Subpàgines al llistat');
	  //$this->widgetSchema->setHelp('nivells_sub','Si la pàgina té subpàgines, aquestes apareixeran llistades a sota dels continguts de la pàgina.<br />Aquí hi podeu triar quants nivells de subpàgines han d\'aparèixer al llistat.');

	  $opcions_mare = array();
	  $dbpages = PageTable::findRootPages();
	  foreach($dbpages as $p) {
		$opcions_mare[$p->id] = $p->titre;
		$this->addSubPages($p,$opcions_mare);
	  }
	  if ($this->isNew() || $this->getObject()->parent_id) {
			$this->widgetSchema['parent_id'] = new sfWidgetFormChoice(array('choices' => $opcions_mare));
		    $this->widgetSchema['parent_id']->setOption('label','Pàgina mare');
	  } else unset($this['parent_id']);

      $dir = sfConfig::get('app_path_images_llistat');
      $relUrlRoot = sfContext::getInstance()->getRequest()->getRelativeUrlRoot();
      $this->widgetSchema['image'] = new MySfWidgetFormInputFileEditable(array(
          'file_src'  => $relUrlRoot.$dir.$this->getObject()->getImage(),
          'is_image'  => true,
          'with_delete' => true,
          'edit_mode' => !$this->isNew() && $this->getObject()->getImage()!="" && file_exists(sfConfig::get('sf_web_dir').$dir.$this->getObject()->getImage()),
          'template'  => '%file% %input%<br />%delete% %delete_label%',
		  'delete_label' => 'Esborrar la imatge actual'
        ),array('class'=>'imatge'));
      $this->widgetSchema->setLabel('image','Imatge per als llistats');
      $this->validatorSchema['image'] = new MySfValidatorFileImage(array(
        'required'                          =>  false,
        'path'                              =>  sfConfig::get('sf_web_dir').$dir,
        'exact_size_x'                      =>  140,
        'exact_size_y'                        => 140,
        'old_src'  => $this->getObject()->getImage()
        ));
	  $this->validatorSchema['image_delete'] = new sfValidatorBoolean(); 
	  
	  $this->widgetSchema->setHelp('image','Mides exactes: 140px ample ; 140px alt.');

	  $this->embedI18n(array('ca', 'es', 'en', 'fr'));
      $this->widgetSchema->setLabel('ca', 'Català');
      $this->widgetSchema->setLabel('es', 'Castellà');
      $this->widgetSchema->setLabel('en', 'Anglès');
      $this->widgetSchema->setLabel('fr', 'Francès');
	  
  }
	private function addSubPages($p,&$pages,$prefix='- ') {
		foreach($p->SubPages as $sp) {
			if ($sp->id != $this->getObject()->id) {
				$pages[$sp->id] = $prefix.$sp->titre;
				$this->addSubPages($sp,$pages,$prefix.'- ');
			}
		}
	}
  
}
