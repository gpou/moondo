[?php

/**
 * <?php echo $this->getModuleName() ?> module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage <?php echo $this->getModuleName()."\n" ?>
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: helper.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class Base<?php echo ucfirst($this->getModuleName()) ?>GeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? '<?php echo $this->params['route_prefix'] ?>' : '<?php echo $this->params['route_prefix'] ?>_'.$action;
  }
  
  public function getBaseUrlForEdit($<?php echo $this->getSingularName() ?>)
  {
  return 'modifica_entitat_'.$entitat->id;
    return url_for($this->getUrlForAction('edit'),$<?php echo $this->getSingularName() ?>);
  }
  
  public function linkToEdit($object, $params)
  {
    return '<li class="sf_admin_action_edit"><a href="'.$this->getBaseUrlForEdit($object).'">'.__($params['label'], array(), 'sf_admin').'</li>';
  }
  
}
