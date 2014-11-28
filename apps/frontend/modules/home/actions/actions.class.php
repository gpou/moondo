<?php

/**
 * home actions.
 *
 * @package    moondo
 * @subpackage home
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homeActions extends sfActions
{

    public function executeIndex(sfWebRequest $request)
    {
		$this->getRequest()->setParameter('slug', PageTable::getPage(45)->slug);
		$this->forward('espectacles','index');
		//$this->pagina_escoles = PageTable::getInstance()->find(62);
		//$this->pagina_mono = PageTable::getInstance()->find(60);
    }
	
	public function executeLanguage(sfWebRequest $request)
    {
		$this->redirect(sfProjectConfiguration::getActive()->generateFrontendUrl('espectacles',array('slug'=>PageTable::getPage(45)->slug)));
    }

}
