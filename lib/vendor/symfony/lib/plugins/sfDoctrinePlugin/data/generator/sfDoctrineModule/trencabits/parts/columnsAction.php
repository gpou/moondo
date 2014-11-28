  protected function getListColumns()
  {
    if (null !== $columns = $this->getUser()->getAttribute('<?php echo $this->getModuleName() ?>.columns', null, 'admin_module'))
    {
      return $columns;
    }

    $this->setListColumns($this->configuration->getListDisplayOn());

    return $this->getUser()->getAttribute('<?php echo $this->getModuleName() ?>.columns', null, 'admin_module');
  }

  protected function setListColumns(array $columns)
  {
    $this->getUser()->setAttribute('<?php echo $this->getModuleName() ?>.columns', $columns, 'admin_module');
  }

  public function executeColumns(sfWebRequest $request)
  {
    $columns = $request->getParameter('columns');
	foreach($columns as $column=>$checked) {
		$cols[] = $column;
	}
	$this->setListColumns($cols);

	$this->redirect('@<?php echo $this->getUrlForAction('list') ?>');
  }
