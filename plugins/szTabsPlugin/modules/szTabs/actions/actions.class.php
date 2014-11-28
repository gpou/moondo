<?php

/**
 * szTabs actions.
 *
 * @package    laplateformepatrimoniale
 * @subpackage szTabsPlugin
 * @author     Sergio Zambrano <sergio@sergiozambrano.es>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class szTabsActions extends sfActions {
	public function executeGuardar(sfWebRequest $request) {
		sfContext::getInstance()->getUser()->setAttribute($request->getParameter('tab_module').'.'.$request->getParameter('tab_action').'.tab', $request->getParameter('tab_value'));
		return sfView::HEADER_ONLY;
	}
}
