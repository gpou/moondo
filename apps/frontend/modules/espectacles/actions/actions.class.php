<?php

/**
 * home actions.
 *
 * @package    moondo
 * @subpackage home
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class espectaclesActions extends sfActions
{
	private function getPage($request) 
	{
		$this->slug = $request->getParameter('slug');
		$this->page = PageTable::getInstance()->findOneBySlug($this->slug);
	}
	private function getApartat($id) 
	{
		sfConfig::set('apartat',PageTable::getApartat($id));
		$this->getResponse()->addStyleSheet(sfConfig::get('apartat'),'last');
	}

    public function executeIndex(sfWebRequest $request)
    {
		$this->getPage($request);
		$this->getApartat($this->page->id);
    }

    public function executeFitxa(sfWebRequest $request)
    {
		$this->getPage($request);
		$this->getApartat($this->page->Apartat->id);
    }
}
