<?php

class cmsComponents extends sfActions
{
    public function executeMenu(sfWebRequest $request)
    {
		$this->pageEspectacles = PageTable::getInstance()->findOneById(49);
		if ($this->page!=null && !$this->page->visible) $this->page = null;
    }
	
    public function executeSubmenu(sfWebRequest $request)
    {
		$this->page = PageTable::getInstance()->findOneBySlug($this->parentSlug);
		if ($this->page!=null && !$this->page->visible) $this->page = null;
    }
}