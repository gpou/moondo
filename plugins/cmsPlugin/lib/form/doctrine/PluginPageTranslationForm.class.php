<?php

/**
 * PluginPageTranslation form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginPageTranslationForm extends BasePageTranslationForm
{
	public function configure()
	{
		$this->widgetSchema->setLabel('titre', 'Títol');
		unset($this['slug']);

		$dbpages = PageTable::findRootPages();
		$pages = array();
		foreach($dbpages as $p) {
			$pages[] = array($p->titre,$p->id);
			$this->addSubPages($p,$pages);
		}
		//$sfMediaBrowserUrl = sfContext::getInstance()->getRouting()->generate('sf_media_browser_select', 
		//		array('dir' => sfConfig::get('app_sf_media_browser_root_dir').'/documentation'));
		$this->widgetSchema['text'] = new sfWidgetFormCKEditor(array('jsoptions'=>array(
			'customConfig' => 'configCms.js',
			//'filebrowserBrowseUrl'=>$sfMediaBrowserUrl, 
			'linkPages'=>$pages,
			'height'=>'50px'
		)));
		$this->widgetSchema->setLabel('text', 'Text curt<br />pels llistats');
	  $this->widgetSchema->setHelp('text','Aquest text apareixerà a la pàgina mare, al llistat de subpàgines que apareix a sota dels continguts.');
	}
	
	private function addSubPages($p,&$pages,$prefix='- ') {
		foreach($p->SubPages as $sp) {
			$pages[] = array($prefix.$sp->titre,$sp->id);
			$this->addSubPages($sp,$pages,$prefix.'- ');
		}
	}
	
}
