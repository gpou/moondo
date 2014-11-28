<?php

/**
 * PluginPageContentImage
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class PluginPageContentImage extends BasePageContentImage
{
    public function preDelete($event)
    {
		$path = sfConfig::get('app_path_images_petites');
        $arxiu = sfConfig::get('sf_web_dir').$path.$this->getImageSmall();
        if (file_exists($arxiu)) { @unlink($arxiu);  }
		$path = sfConfig::get('app_path_images');
        $arxiu = sfConfig::get('sf_web_dir').$path.$this->getImage();
        if (file_exists($arxiu)) { @unlink($arxiu);  }
		parent::preDelete($event);
	}
    
    public function getImageSize() {
		$path = sfConfig::get('app_path_images_petites');
        $arxiu = sfConfig::get('sf_web_dir').$path.$this->getImageSmall();
        $size = getimagesize($arxiu);
        return array('width'=>$size[0],'height'=>$size[1]);
    }

}