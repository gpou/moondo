<?php

/**
 * PluginPageContentDoc
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class PluginPageContentDoc extends BasePageContentDoc
{
    public function preDelete($event)
    {
		$path = sfConfig::get('app_path_docs');
        $arxiu = sfConfig::get('sf_web_dir').$path.$this->getUrl();
        if (file_exists($arxiu)) { @unlink($arxiu);  }
		parent::preDelete($event);
	}

}