<?php
class moondoApplicationConfiguration extends sfApplicationConfiguration {
	protected $frontendRouting      = null;
	protected $backendRouting       = null;
	
	public function generateFrontendUrl($name, $parameters = array()) {
		$routing = $this->getFrontendRouting();
		if ($routing->hasRouteName($name)) {
			return $this->getBaseFrontendUrl().$routing->generate($name, $parameters);
		} else {
			$routing = sfContext::getInstance()->getRouting();
			if ($routing->hasRouteName($name)) {
				$routingOptions = $routing->getOptions();
				$urlPrefix = (array_key_exists("prefix", $routingOptions["context"]) ? $routingOptions["context"]["prefix"] : "");
				$myURL = sfContext::getInstance()->getRouting()->generate($name, $parameters);
				$myURL = str_replace($urlPrefix, "", $myURL);
				return $this->getBaseFrontendUrl().$myURL;
			}
		}
		return false;
	}

	public function getBaseFrontendUrl() {
		$env = sfApplicationConfiguration::getEnvironment();
		if( $env !== 'prod' ) return 'http://'.$_SERVER['SERVER_NAME'].'/frontend_'.$env.'.php';
		else return 'http://'.$_SERVER['SERVER_NAME'];
	}
	
	public function getFrontendRouting() {
		if (!$this->frontendRouting) {
			$this->frontendRouting = new sfPatternRouting(new sfEventDispatcher());
			$config = new sfRoutingConfigHandler();
			$routes = $config->evaluate(array(sfConfig::get('sf_apps_dir').'/frontend/config/routing.yml'));
			$this->frontendRouting->setRoutes($routes);
		}
		return $this->frontendRouting;
	}
	
	
	public function generateBackendUrl($name, $parameters = array()) {
		$routing = $this->getBackendRouting();
		if ($routing->hasRouteName($name)) {
			return $this->getBaseBackendUrl().$routing->generate($name, $parameters);
		} else {
			$routing = sfContext::getInstance()->getRouting();
			if ($routing->hasRouteName($name)) {
				$routingOptions = $routing->getOptions();
				$urlPrefix = (array_key_exists("prefix", $routingOptions["context"]) ? $routingOptions["context"]["prefix"] : "");
				$myURL = sfContext::getInstance()->getRouting()->generate($name, $parameters);
				$myURL = str_replace($urlPrefix, "", $myURL);
				return $this->getBaseBackendUrl().$myURL;
			}
		}
		return false;
	}

	public function getBaseBackendUrl() {
		$env = sfApplicationConfiguration::getEnvironment();
		if( $env !== 'prod' ) return 'http://'.$_SERVER['SERVER_NAME'].'/backend_'.$env.'.php';
		else return 'http://'.$_SERVER['SERVER_NAME'].'/backend.php';
	}
	
	public function getBackendRouting() {
		if (!$this->backendRouting) {
			$this->backendRouting = new sfPatternRouting(new sfEventDispatcher());
			$config = new sfRoutingConfigHandler();
			$routes = $config->evaluate(array(sfConfig::get('sf_apps_dir').'/backend/config/routing.yml'));
			$this->backendRouting->setRoutes($routes);
		}
		return $this->backendRouting;
	}
	

}