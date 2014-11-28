<?php
class sfWidgetFormPlain extends sfWidgetForm
{
      protected function configure($options = array(), $attributes = array()) {
		  parent::configure($options, $attributes);
		  $this->addOption('type', 'text');
	  }
    
      public function render($name, $value = null, $attributes = array(), $errors = array())
      {
        // just return the value, here you could wrap it into  a call to content_tag('span') and add your options,
        // just have a look on how to do that in sfWidgetFormInput.class.php  in the symfony library directory
        switch($this->getOption('type')) {
			case 'boolean': if ($value) return 'Si'; else return 'No'; break;
			case 'text': 
			default: return $value; break;
		}
      }
}
	