<?php

function addtab($name, $value = null) {
	$context    = sfContext::getInstance();
	$attributes = $context->getUser()->getAttributeHolder();

	$tab_names = sfConfig::get('symfony.view.tab_names', array());
	if (in_array($name, $tab_names)) {
		throw new sfCacheException(sprintf('A tab named "%s" is already started.', $name));
	}

	if (sfConfig::get('sf_logging_enabled')) {
		$context->getEventDispatcher()->notify(new sfEvent(null, 'application.log', array(sprintf('Set tab "%s"', $name))));
	}

	$tabs = $attributes->get('tabs', array());
	if (null !== $value) {
		$tabs[$name] = $value;
		$attributes->set('tabs', $tabs);
		return;
	}

	$tab_names[] = $name;

	$tabs[$name] = '';
	$attributes->set('tabs', $tabs);
	sfConfig::set('symfony.view.tab_names', $tab_names);

	ob_start();
	ob_implicit_flush(0);
}

function end_tab() {
	$content = ob_get_clean();

	$context = sfContext::getInstance();
	$attributes = $context->getUser()->getAttributeHolder();

	$tab_names = sfConfig::get('symfony.view.tab_names', array());
	if (!$tab_names) {
		throw new sfCacheException('No tab started.');
	}

	$tabs        = $attributes->get('tabs', array());
	$name        = array_pop($tab_names);
	$tabs[$name] = $content;
	$attributes->set('tabs', $tabs);
	sfConfig::set('symfony.view.tab_names', $tab_names);
}

function has_tab($name) {
  return array_key_exists($name, sfContext::getInstance()->getUser()->getAttributeHolder()->get('tabs', array()));
}

function include_tabs($clear=true) {
	print get_tabs($clear);
}

function get_tabs($clear=true) {
	$context = sfContext::getInstance();
	$tabs    = $context->getUser()->getAttributeHolder()->get('tabs', array());

	if (sfConfig::get('sf_logging_enabled')) {
		$context->getEventDispatcher()->notify(new sfEvent(null, 'application.log', array('Get slots')));
	}

	if( !count($tabs) ) {
		return '';
	}

	$pestanas   = '';
	$contenidos = '';

	$indice = 1;
	$context = sfContext::getInstance();
	$config = urldecode(sfContext::getInstance()->getUser()->getAttribute($context->getModuleName().'.'.$context->getActionName().'.tab', false));
	foreach($tabs as $name => $content) {
		$pestanas   .= '<li><a href="#tab'.$indice.'" rel="'.url_for('save_active_tab',array('tab_module'=>$context->getModuleName(), 'tab_action'=>$context->getActionName(), 'tab_value'=>'#tab'.$indice)).'">'.$name.'</a></li>';
		$contenidos .= '<div id="tab'.$indice.'" class="tab_content">';
		if( '#tab'.$indice === $config ) {
			$contenidos .= '<a name="activetab" />';
		}
		$contenidos .= $content.'</div>';
		$indice++;
	}

	if( $clear ) {
		$context->getUser()->getAttributeHolder()->set('tabs', array());
		sfConfig::set('symfony.view.tab_names', array());
	}
	_tabs_addAssets();
	return '<ul class="tabs">'.$pestanas.'</ul><div class="tab_container">'.$contenidos.'</div>';
}

function _tabs_addAssets() {
	$response = sfContext::getInstance()->getResponse();
	$response->addJavascript('/szTabsPlugin/js/jquery.tabs.js', 'last');
}
