<?php

/**
 * PluginPageContentAudio form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginPageContentAudioForm extends BasePageContentAudioForm
{
  public function configure()
  {
	  unset($this['position']);
	  $this->widgetSchema['url'] = new sfWidgetFormSoundCloud();
	  $this->widgetSchema->setLabel('url','Pista d\'audio de SoundCloud');
//	  $this->widgetSchema->setHelp('url','Podeu introduïr l\'adreça de l\'àudio a SoundCloud (ex: http://soundcloud.com/khancartro/cancion-de-maia).<br />El sistema ja n\'extreurà el codi.');
	  $this->widgetSchema['content_id'] = new sfWidgetFormInputHidden();
	  $this->embedI18n(array('ca', 'es', 'en', 'fr'));
	  $this->widgetSchema->setLabel('ca', 'Títol Català');
	  $this->widgetSchema->setLabel('es', 'Títol Castellà');
	  $this->widgetSchema->setLabel('en', 'Títol Anglès');
	  $this->widgetSchema->setLabel('fr', 'Títol Francès');
	  
  }
	
}
