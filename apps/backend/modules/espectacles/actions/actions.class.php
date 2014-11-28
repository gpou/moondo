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

    public function executeIndex(sfWebRequest $request)
    {
		$this->page = PageTable::getInstance()->findOneById(49);
    }
    public function executePage(sfWebRequest $request)
    {
		$id = $request->getParameter('id');
		$this->page = PageTable::getInstance()->findOneById($id);
    }

}
