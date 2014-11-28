<?php

/**
 * PluginPageContentTranslation form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginPageContentTranslationForm extends BasePageContentTranslationForm
{
  public function configure()
  {
		$dbpages = PageTable::findRootPages();
		$pages = array();
		foreach($dbpages as $p) {
			$pages[] = array($p->titre,$p->id);
			$this->addSubPages($p,$pages);
		}
		if ($this->isNew()) {
			$tipus = sfContext::getInstance()->getRequest()->getParameter('type');
		} else {
			$tipus = PageContentTable::getInstance()->findOneBy('id',$this->getObject()->id)->type;
		}
		$sfMediaBrowserUrl = sfContext::getInstance()->getRouting()->generate('sf_media_browser_select', 
				array('dir' => sfConfig::get('app_sf_media_browser_root_dir').'/documentation'));
		$this->widgetSchema['text'] = new sfWidgetFormCKEditor(array('jsoptions'=>array(
			'customConfig' => 'configCms.js',
			'filebrowserBrowseUrl'=>$sfMediaBrowserUrl, 
			'linkPages'=>$pages,
			'height'=>($tipus=='text')?'300px':'30px'
		)));
	  $this->widgetSchema->setLabel('text', ' ');
		
	}
	private function addSubPages($p,&$pages,$prefix='- ') {
		foreach($p->SubPages as $sp) {
			$pages[] = array($prefix.$sp->titre,$sp->id);
			$this->addSubPages($sp,$pages,$prefix.'- ');
		}
	}
}
