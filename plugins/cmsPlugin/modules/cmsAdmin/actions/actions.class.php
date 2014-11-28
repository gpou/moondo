<?php

class cmsAdminActions extends sfActions
{
	public function preExecute()  
	{
		parent::preExecute();
	}
    public function executeIndex(sfWebRequest $request)
    {
		if (!$request->hasParameter('id')) $id = $this->getUser()->getAttribute('apartat',0,'cmsAdmin');
		else $id = $request->getParameter('id');
		$this->page = PageTable::getInstance()->findOneById($id);
		$this->getUser()->setAttribute('apartat',$this->page->id,'cmsAdmin');
    }

	
	/* PAGES ******************************************************************/
	
	public function executePageOnline(sfWebRequest $request)
	{
		$page = $this->getRoute()->getObject();
		$page->setVisible(true);
		$page->save();
		$this->redirect(array('sf_route' => 'cms_admin'));
	}
	public function executePageOffline(sfWebRequest $request)
	{
		$page = $this->getRoute()->getObject();
		$page->setVisible(false);
		$page->save();
		$this->redirect(array('sf_route' => 'cms_admin'));
	}
	
	public function executePagePromote(sfWebRequest $request)
	{
		$page = $this->getRoute()->getObject();
		$page->promote();
		$this->redirect(array('sf_route' => 'cms_admin'));
	}
	public function executePageDemote(sfWebRequest $request)
	{
		$page = $this->getRoute()->getObject();
		$page->demote();
		$this->redirect(array('sf_route' => 'cms_admin'));
	}

	public function executePageNew(sfWebRequest $request)
	{
		$this->page = new Page();
		$this->page->parent_id = PageTable::getDefaultParentPageId();
		$this->form = new PageForm($this->page);
	}
	
	public function executePageCreate(sfWebRequest $request)
	{
		$this->page = new Page();
		$this->page->parent_id = PageTable::getDefaultParentPageId();
		$this->form = new PageForm($this->page);
		$this->processPageForm($request, $this->form);
		$this->setTemplate('pageNew');
	}
	
	public function executePageEdit(sfWebRequest $request)
	{
		$this->page = $this->getRoute()->getObject();
		$this->form = new PageForm($this->page);
	} 
	
	public function executePageUpdate(sfWebRequest $request)
	{
		$this->page = $this->getRoute()->getObject();
		$this->form = new PageForm($this->page);
		$this->processPageForm($request, $this->form);
		$this->setTemplate('pageEdit');
	} 
	
	public function executePageDelete(sfWebRequest $request)
	{
		$this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));
		if ($this->getRoute()->getObject()->delete())
		{
			$this->getUser()->setFlash('notice', 'La pàgina s\'ha eliminat.');
		}
		$this->redirect('cms_admin');
	}
	
	
	
	/* CONTENTS ******************************************************/
	
	public function executeContentOnline(sfWebRequest $request)
	{
		$this->content = $this->getRoute()->getObject();
		$this->content->setVisible(true);
		$this->content->save();
		$this->setTemplate('contentOnlineOffline');
	}
	public function executeContentOffline(sfWebRequest $request)
	{
		$this->content = $this->getRoute()->getObject();
		$this->content->setVisible(false);
		$this->content->save();
		$this->setTemplate('contentOnlineOffline');
	}
	public function executeContentPromote(sfWebRequest $request)
	{
		$content = $this->getRoute()->getObject();
		$content->promote();
		$this->redirect(array('sf_route' => 'cms_admin_page_edit','sf_subject'=>$content->Page));
	}
	public function executeContentDemote(sfWebRequest $request)
	{
		$content = $this->getRoute()->getObject();
		$content->demote();
		$this->redirect(array('sf_route' => 'cms_admin_page_edit','sf_subject'=>$content->Page));
	}

	public function executeContent(sfWebRequest $request)
	{
		$this->content = $this->getRoute()->getObject();
	}
	
	public function executeContentNew(sfWebRequest $request)
	{
		$this->page = $this->getRoute()->getObject();
		$this->content = new PageContent();
		$this->content->page_id = $this->page->id;
		$this->type = $request->getParameter('type');
		$this->content->type = $this->type;
		$this->form = new PageContentForm($this->content);
	}
	
	public function executeContentCreate(sfWebRequest $request)
	{
		$this->page = $this->getRoute()->getObject();
		$this->content = new PageContent();
		$this->content->page_id = $this->page->id;
		$this->type = $request->getParameter('type');
		$this->content->type = $this->type;
		$this->form = new PageContentForm($this->content);
		if ($this->processContentForm($request, $this->form))
			$this->redirect(array('sf_route' => 'cms_admin_content_created', 'sf_subject' => $this->content));
		else $this->setTemplate('contentNew');
	}
	
	public function executeContentCreated(sfWebRequest $request)
	{
		$this->content = $this->getRoute()->getObject();
		$this->page = $this->content->Page;
		$this->getUser()->setFlash('notice', "S'ha creat el contingut",false);
		sfConfig::set('sf_web_debug', false);
	}
	
	
	public function executeContentEdit(sfWebRequest $request)
	{
		$this->content = $this->getRoute()->getObject();
		$this->page = $this->content->Page;
		$this->form = new PageContentForm($this->content);
		$this->setTemplate('contentEdit_'.$this->content->type);
	} 
	
	public function executeContentUpdate(sfWebRequest $request)
	{
		$this->content = $this->getRoute()->getObject();
		$this->page = $this->content->Page;
		$this->form = new PageContentForm($this->content);
		if ($this->processContentForm($request, $this->form)) 
			$this->redirect(array('sf_route' => 'cms_admin_content', 'sf_subject' => $this->content));
		else $this->setTemplate('contentEdit');
	} 
	
	public function executeContentDelete(sfWebRequest $request)
	{
		$object = $this->getRoute()->getObject();
		$this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $object)));
		if ($object->delete())
		{
			$this->getUser()->setFlash('notice', 'El contingut s\'ha eliminat.',false);
		}
		//$this->redirect(array('sf_route' => 'cms_admin_page_edit', 'sf_subject' => $object->Page));
	}
	
	public function executeContentUsers(sfWebRequest $request)
	{
		$this->content = $this->getRoute()->getObject();
	}

	public function executeContentUsersEdit(sfWebRequest $request)
	{
		$this->content = $this->getRoute()->getObject();
		$this->form = new PageContentForm($this->content, array('users'=>true));
	} 
	
	public function executeContentUsersUpdate(sfWebRequest $request)
	{
		$this->content = $this->getRoute()->getObject();
		$this->form = new PageContentForm($this->content, array('users'=>true));
		if ($this->processContentForm($request, $this->form)) 
			$this->redirect(array('sf_route' => 'cms_admin_content_users', 'sf_subject' => $this->content));
		else $this->setTemplate('contentUsersEdit');
	} 

	
	/* FORMS ******************************************************************/
	
  protected function processPageForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'S\'ha creat la pàgina.' : 'S\'ha actualitzat la pàgina.';
      try {
        $page = $form->save();
      } catch (Doctrine_Validator_Exception $e) {
        $errorStack = $form->getObject()->getErrorStack();
        $message = get_class($form->getObject()) . ' té ' . count($errorStack) . " camps" . (count($errorStack) > 1 ?  's' : null) . " amb errors: ";
        foreach ($errorStack as $field => $errors) {
            $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');
        $this->getUser()->setFlash('error', $message);
        return sfView::SUCCESS;
      }

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $page)));
      $this->getUser()->setFlash('notice', $notice);
      $this->redirect(array('sf_route' => 'cms_admin_page_edit', 'sf_subject' => $page));
    }
    else
    {
		$error = $form->getObject()->isNew()?'La pàgina no s\'ha pogut crear.':'La pàgina no s\'ha pogut actualitzar.';
      $this->getUser()->setFlash('error', $error, false);
    }
  }	
	
  protected function processContentForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'S\'ha creat el contingut.' : 'El contingut s\'ha actualitzat.';
      try {
        $content = $form->save();
      } catch (Doctrine_Validator_Exception $e) {
        $errorStack = $form->getObject()->getErrorStack();
        $message = get_class($form->getObject()) . ' té ' . count($errorStack) . " camps" . (count($errorStack) > 1 ?  's' : null) . " amb errors: ";
        foreach ($errorStack as $field => $errors) {
            $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');
        $this->getUser()->setFlash('error', $message);
        return false;
      }

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $content)));
      $this->getUser()->setFlash('notice', $notice);
      return true;
    }
    else
    {
      $this->getUser()->setFlash('error', 'El contingut no s\'ha pogut actualitzar.', false);
	  return false;
    }
  }	  
  
  
	
	/* imatges ***********************************************/
	
	public function executeImagePromote(sfWebRequest $request)
	{
		$image = $this->getRoute()->getObject();
		$image->promote();
		$this->redirect(array('sf_route' => 'cms_admin_page_edit','sf_subject'=>$image->PageContent->Page));
	}
	public function executeImageDemote(sfWebRequest $request)
	{
		$image = $this->getRoute()->getObject();
		$image->demote();
		$this->redirect(array('sf_route' => 'cms_admin_page_edit','sf_subject'=>$image->PageContent->Page));
	}
	
	public function executeImageNew(sfWebRequest $request)
	{
		$this->content = $this->getRoute()->getObject();
		$this->page = $this->content->Page;
		$this->image = new PageContentImage();
		$this->image->content_id = $this->content->id;
		$this->form = new PageContentImageForm($this->image);
	}
	
	public function executeImageCreate(sfWebRequest $request)
	{
		$this->content = $this->getRoute()->getObject();
		$this->page = $this->content->Page;
		$this->image = new PageContentImage();
		$this->image->content_id = $this->content->id;
		$this->form = new PageContentImageForm($this->image);
		if ($this->processImageForm($request, $this->form))
			$this->redirect(array('sf_route' => 'cms_admin_page_edit', 'sf_subject' => $this->page));
		else $this->setTemplate('imageNew');
	}
	
	public function executeImageEdit(sfWebRequest $request)
	{
		$this->image = $this->getRoute()->getObject();
		$this->content = $this->image->PageContent;
		$this->page = $this->content->Page;
		$this->form = new PageContentImageForm($this->image);
	} 
	
	public function executeImageUpdate(sfWebRequest $request)
	{
		$this->image = $this->getRoute()->getObject();
		$this->content = $this->image->PageContent;
		$this->page = $this->content->Page;
		$this->form = new PageContentImageForm($this->image);
		if ($this->processImageForm($request, $this->form)) 
			$this->redirect(array('sf_route' => 'cms_admin_page_edit', 'sf_subject' => $this->page));
		else $this->setTemplate('imageEdit');
	} 
	
	public function executeImageDelete(sfWebRequest $request)
	{
		$object = $this->getRoute()->getObject();
		$this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $object)));
		if ($object->delete())
		{
			$this->getUser()->setFlash('notice', 'La imatge s\'ha eliminat.');
		}
		$this->redirect(array('sf_route' => 'cms_admin_page_edit', 'sf_subject' => $object->PageContent->Page));
	}
	
	  
  protected function processImageForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'S\'ha creat la imatge.' : 'La imatge s\'ha actualitzat.';
      try {
        $content = $form->save();
      } catch (Doctrine_Validator_Exception $e) {
        $errorStack = $form->getObject()->getErrorStack();
        $message = get_class($form->getObject()) . ' té ' . count($errorStack) . " camps" . (count($errorStack) > 1 ?  's' : null) . " amb errors: ";
        foreach ($errorStack as $field => $errors) {
            $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');
        $this->getUser()->setFlash('error', $message);
        return false;
      }

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $content)));
      $this->getUser()->setFlash('notice', $notice);
      return true;
    }
    else
    {
      $this->getUser()->setFlash('error', 'La imatge no s\'ha pogut actualitzar.', false);
	  return false;
    }
  }	    
	
  
  
  
	
	/* docs ***********************************************/
	
	public function executeDocPromote(sfWebRequest $request)
	{
		$doc = $this->getRoute()->getObject();
		$doc->promote();
		$this->redirect(array('sf_route' => 'cms_admin_page_edit','sf_subject'=>$doc->PageContent->Page));
	}
	public function executeDocDemote(sfWebRequest $request)
	{
		$doc = $this->getRoute()->getObject();
		$doc->demote();
		$this->redirect(array('sf_route' => 'cms_admin_page_edit','sf_subject'=>$doc->PageContent->Page));
	}
	
	public function executeDocNew(sfWebRequest $request)
	{
		$this->content = $this->getRoute()->getObject();
		$this->page = $this->content->Page;
		$this->doc = new PageContentDoc();
		$this->doc->content_id = $this->content->id;
		$this->form = new PageContentDocForm($this->doc);
	}
	
	public function executeDocCreate(sfWebRequest $request)
	{
		$this->content = $this->getRoute()->getObject();
		$this->page = $this->content->Page;
		$this->doc = new PageContentDoc();
		$this->doc->content_id = $this->content->id;
		$this->form = new PageContentDocForm($this->doc);
		if ($this->processDocForm($request, $this->form))
			$this->redirect(array('sf_route' => 'cms_admin_page_edit', 'sf_subject' => $this->page));
		else $this->setTemplate('docNew');
	}
	
	public function executeDocEdit(sfWebRequest $request)
	{
		$this->doc = $this->getRoute()->getObject();
		$this->content = $this->doc->PageContent;
		$this->page = $this->content->Page;
		$this->form = new PageContentDocForm($this->doc);
	} 
	
	public function executeDocUpdate(sfWebRequest $request)
	{
		$this->doc = $this->getRoute()->getObject();
		$this->content = $this->doc->PageContent;
		$this->page = $this->content->Page;
		$this->form = new PageContentDocForm($this->doc);
		if ($this->processDocForm($request, $this->form)) 
			$this->redirect(array('sf_route' => 'cms_admin_page_edit', 'sf_subject' => $this->page));
		else $this->setTemplate('docEdit');
	} 
	
	public function executeDocDelete(sfWebRequest $request)
	{
		$object = $this->getRoute()->getObject();
		$this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $object)));
		if ($object->delete())
		{
			$this->getUser()->setFlash('notice', 'El document s\'ha eliminat.');
		}
		$this->redirect(array('sf_route' => 'cms_admin_page_edit', 'sf_subject' => $object->PageContent->Page));
	}
	
	  
  protected function processDocForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'S\'ha creat el document.' : 'El document s\'ha actualitzat.';
      try {
        $content = $form->save();
      } catch (Doctrine_Validator_Exception $e) {
        $errorStack = $form->getObject()->getErrorStack();
        $message = get_class($form->getObject()) . ' té ' . count($errorStack) . " camps" . (count($errorStack) > 1 ?  's' : null) . " amb errors: ";
        foreach ($errorStack as $field => $errors) {
            $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');
        $this->getUser()->setFlash('error', $message);
        return false;
      }

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $content)));
      $this->getUser()->setFlash('notice', $notice);
      return true;
    }
    else
    {
      $this->getUser()->setFlash('error', 'El document no s\'ha pogut actualitzar.', false);
	  return false;
    }
  }	    
	  
  
  
  
  
	
	/* videos ***********************************************/
	
	public function executeVideoPromote(sfWebRequest $request)
	{
		$video = $this->getRoute()->getObject();
		$video->promote();
		$this->redirect(array('sf_route' => 'cms_admin_page_edit','sf_subject'=>$video->PageContent->Page));
	}
	public function executeVideoDemote(sfWebRequest $request)
	{
		$video = $this->getRoute()->getObject();
		$video->demote();
		$this->redirect(array('sf_route' => 'cms_admin_page_edit','sf_subject'=>$video->PageContent->Page));
	}
	
	public function executeVideoNew(sfWebRequest $request)
	{
		$this->content = $this->getRoute()->getObject();
		$this->page = $this->content->Page;
		$this->video = new PageContentVideo();
		$this->video->content_id = $this->content->id;
		$this->form = new PageContentVideoForm($this->video);
	}
	
	public function executeVideoCreate(sfWebRequest $request)
	{
		$this->content = $this->getRoute()->getObject();
		$this->page = $this->content->Page;
		$this->video = new PageContentVideo();
		$this->video->content_id = $this->content->id;
		$this->form = new PageContentVideoForm($this->video);
		if ($this->processVideoForm($request, $this->form))
			$this->redirect(array('sf_route' => 'cms_admin_page_edit', 'sf_subject' => $this->page));
		else $this->setTemplate('videoNew');
	}
	
	public function executeVideoEdit(sfWebRequest $request)
	{
		$this->video = $this->getRoute()->getObject();
		$this->content = $this->video->PageContent;
		$this->page = $this->content->Page;
		$this->form = new PageContentVideoForm($this->video);
	} 
	
	public function executeVideoUpdate(sfWebRequest $request)
	{
		$this->video = $this->getRoute()->getObject();
		$this->content = $this->video->PageContent;
		$this->page = $this->content->Page;
		$this->form = new PageContentVideoForm($this->video);
		if ($this->processVideoForm($request, $this->form)) 
			$this->redirect(array('sf_route' => 'cms_admin_page_edit', 'sf_subject' => $this->page));
		else $this->setTemplate('videoEdit');
	} 
	
	public function executeVideoDelete(sfWebRequest $request)
	{
		$object = $this->getRoute()->getObject();
		$this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $object)));
		if ($object->delete())
		{
			$this->getUser()->setFlash('notice', 'El vídeo s\'ha eliminat.');
		}
		$this->redirect(array('sf_route' => 'cms_admin_page_edit', 'sf_subject' => $object->PageContent->Page));
	}
	
	  
  protected function processVideoForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'S\'ha creat el vídeo.' : 'El vídeo s\'ha actualitzat.';
      try {
        $content = $form->save();
      } catch (Doctrine_Validator_Exception $e) {
        $errorStack = $form->getObject()->getErrorStack();
        $message = get_class($form->getObject()) . ' té ' . count($errorStack) . " camps" . (count($errorStack) > 1 ?  's' : null) . " amb errors: ";
        foreach ($errorStack as $field => $errors) {
            $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');
        $this->getUser()->setFlash('error', $message);
        return false;
      }

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $content)));
      $this->getUser()->setFlash('notice', $notice);
      return true;
    }
    else
    {
      $this->getUser()->setFlash('error', 'El vídeo no s\'ha pogut actualitzar.', false);
	  return false;
    }
  }	    
	    
  
  
	
	/* audios ***********************************************/
	
	public function executeAudioPromote(sfWebRequest $request)
	{
		$audio = $this->getRoute()->getObject();
		$audio->promote();
		$this->redirect(array('sf_route' => 'cms_admin_page_edit','sf_subject'=>$audio->PageContent->Page));
	}
	public function executeAudioDemote(sfWebRequest $request)
	{
		$audio = $this->getRoute()->getObject();
		$audio->demote();
		$this->redirect(array('sf_route' => 'cms_admin_page_edit','sf_subject'=>$audio->PageContent->Page));
	}
	
	public function executeAudioNew(sfWebRequest $request)
	{
		$this->content = $this->getRoute()->getObject();
		$this->page = $this->content->Page;
		$this->audio = new PageContentAudio();
		$this->audio->content_id = $this->content->id;
		$this->form = new PageContentAudioForm($this->audio);
	}
	
	public function executeAudioCreate(sfWebRequest $request)
	{
		$this->content = $this->getRoute()->getObject();
		$this->page = $this->content->Page;
		$this->audio = new PageContentAudio();
		$this->audio->content_id = $this->content->id;
		$this->form = new PageContentAudioForm($this->audio);
		if ($this->processAudioForm($request, $this->form))
			$this->redirect(array('sf_route' => 'cms_admin_page_edit', 'sf_subject' => $this->page));
		else $this->setTemplate('audioNew');
	}
	
	public function executeAudioEdit(sfWebRequest $request)
	{
		$this->audio = $this->getRoute()->getObject();
		$this->content = $this->audio->PageContent;
		$this->page = $this->content->Page;
		$this->form = new PageContentAudioForm($this->audio);
	} 
	
	public function executeAudioUpdate(sfWebRequest $request)
	{
		$this->audio = $this->getRoute()->getObject();
		$this->content = $this->audio->PageContent;
		$this->page = $this->content->Page;
		$this->form = new PageContentAudioForm($this->audio);
		if ($this->processAudioForm($request, $this->form)) 
			$this->redirect(array('sf_route' => 'cms_admin_page_edit', 'sf_subject' => $this->page));
		else $this->setTemplate('audioEdit');
	} 
	
	public function executeAudioDelete(sfWebRequest $request)
	{
		$object = $this->getRoute()->getObject();
		$this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $object)));
		if ($object->delete())
		{
			$this->getUser()->setFlash('notice', 'L\'audio s\'ha eliminat.');
		}
		$this->redirect(array('sf_route' => 'cms_admin_page_edit', 'sf_subject' => $object->PageContent->Page));
	}
	
	  
  protected function processAudioForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'S\'ha creat l\'audio.' : 'L\'audio s\'ha actualitzat.';
      try {
        $content = $form->save();
      } catch (Doctrine_Validator_Exception $e) {
        $errorStack = $form->getObject()->getErrorStack();
        $message = get_class($form->getObject()) . ' té ' . count($errorStack) . " camps" . (count($errorStack) > 1 ?  's' : null) . " amb errors: ";
        foreach ($errorStack as $field => $errors) {
            $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');
        $this->getUser()->setFlash('error', $message);
        return false;
      }

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $content)));
      $this->getUser()->setFlash('notice', $notice);
      return true;
    }
    else
    {
      $this->getUser()->setFlash('error', 'L\'audio no s\'ha pogut actualitzar.', false);
	  return false;
    }
  }	    
	      
  

	
	/* links ***********************************************/
	
	public function executeLinkPromote(sfWebRequest $request)
	{
		$link = $this->getRoute()->getObject();
		$link->promote();
		$this->redirect(array('sf_route' => 'cms_admin_page_edit','sf_subject'=>$link->PageContent->Page));
	}
	public function executeLinkDemote(sfWebRequest $request)
	{
		$link = $this->getRoute()->getObject();
		$link->demote();
		$this->redirect(array('sf_route' => 'cms_admin_page_edit','sf_subject'=>$link->PageContent->Page));
	}
	
	public function executeLinkNew(sfWebRequest $request)
	{
		$this->content = $this->getRoute()->getObject();
		$this->page = $this->content->Page;
		$this->link = new PageContentLink();
		$this->link->content_id = $this->content->id;
		$this->form = new PageContentLinkForm($this->link);
	}
	
	public function executeLinkCreate(sfWebRequest $request)
	{
		$this->content = $this->getRoute()->getObject();
		$this->page = $this->content->Page;
		$this->link = new PageContentLink();
		$this->link->content_id = $this->content->id;
		$this->form = new PageContentLinkForm($this->link);
		if ($this->processLinkForm($request, $this->form))
			$this->redirect(array('sf_route' => 'cms_admin_page_edit', 'sf_subject' => $this->page));
		else $this->setTemplate('linkNew');
	}
	
	public function executeLinkEdit(sfWebRequest $request)
	{
		$this->link = $this->getRoute()->getObject();
		$this->content = $this->link->PageContent;
		$this->page = $this->content->Page;
		$this->form = new PageContentLinkForm($this->link);
	} 
	
	public function executeLinkUpdate(sfWebRequest $request)
	{
		$this->link = $this->getRoute()->getObject();
		$this->content = $this->link->PageContent;
		$this->page = $this->content->Page;
		$this->form = new PageContentLinkForm($this->link);
		if ($this->processLinkForm($request, $this->form)) 
			$this->redirect(array('sf_route' => 'cms_admin_page_edit', 'sf_subject' => $this->page));
		else $this->setTemplate('linkEdit');
	} 
	
	public function executeLinkDelete(sfWebRequest $request)
	{
		$object = $this->getRoute()->getObject();
		$this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $object)));
		if ($object->delete())
		{
			$this->getUser()->setFlash('notice', 'L\'enllaç s\'ha eliminat.');
		}
		$this->redirect(array('sf_route' => 'cms_admin_page_edit', 'sf_subject' => $object->PageContent->Page));
	}
	
	  
  protected function processLinkForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'S\'ha creat l\'enllaç.' : 'L\'enllaç s\'ha actualitzat.';
      try {
        $content = $form->save();
      } catch (Doctrine_Validator_Exception $e) {
        $errorStack = $form->getObject()->getErrorStack();
        $message = get_class($form->getObject()) . ' té ' . count($errorStack) . " camps" . (count($errorStack) > 1 ?  's' : null) . " amb errors: ";
        foreach ($errorStack as $field => $errors) {
            $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');
        $this->getUser()->setFlash('error', $message);
        return false;
      }

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $content)));
      $this->getUser()->setFlash('notice', $notice);
      return true;
    }
    else
    {
      $this->getUser()->setFlash('error', 'L\'enllaç no s\'ha pogut actualitzar.', false);
	  return false;
    }
  }	    
  
  
}
