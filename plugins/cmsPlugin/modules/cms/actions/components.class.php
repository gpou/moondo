<?php

class cmsComponents extends sfActions
{
    public function executePage(sfWebRequest $request)
    {
		$this->page = PageTable::getInstance()->findOneById($this->id);
		if ($this->page!=null && !$this->page->visible) $this->page = null;
    }
	
	
    public function executeSubmenu(sfWebRequest $request)
    {
		$this->page = PageTable::getInstance()->findOneById($this->parent);
		if ($this->page!=null && !$this->page->visible) $this->page = null;
    }
	
	
}