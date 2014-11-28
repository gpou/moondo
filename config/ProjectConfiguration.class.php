<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
		$this->enablePlugins(array('sfDoctrinePlugin','sfDoctrineGuardPlugin','sfJqueryReloadedPlugin'));
		$this->enablePlugins('sfMediaBrowserPlugin');
//		$this->enablePlugins('ahDoctrineEasyEmbeddedRelationsPlugin');
//		$this->enablePlugins('sfThumbnailPlugin');
		$this->enablePlugins('sfCKEditorPlugin');
		$this->enablePlugins('csDoctrineActAsSortablePlugin');
		$this->enablePlugins('cmsPlugin');
		$this->enablePlugins('szTabsPlugin');
		set_include_path(sfConfig::get('sf_lib_dir').'/vendor'.PATH_SEPARATOR.get_include_path());
  }
}
