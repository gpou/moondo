<?php

class MySfWidgetFormInputFileEditable extends sfWidgetFormInputFileEditable
{

  protected function getFileAsTag($attributes)
  {
    if ($this->getOption('is_image'))
    {
      return parent::getFileAsTag($attributes);
    }
    else
    {
        $nom = basename($this->getOption('file_src'));
      return '<a href="'.$this->getOption('file_src').'" title="descarregar document" target="blank">'.$nom.'</a>';
    }
  }
}