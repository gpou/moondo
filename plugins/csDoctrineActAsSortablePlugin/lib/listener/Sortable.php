<?php


/**
 * Easily sort each record based on position
 *
 * @package     csDoctrineSortablePlugin
 * @subpackage  listener
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.phpdoctrine.org
 * @since       1.0
 * @version     $Revision$
 * @author      Travis Black <tblack@centresource.com>
 */
class Doctrine_Template_Listener_Sortable extends Doctrine_Record_Listener
{
  /**
   * Array of sortable options
   *
   * @var array
   */
  protected $_options = array();


  /**
   * __construct
   *
   * @param array $options 
   * @return void
   */  
  public function __construct(array $options)
  {
    $this->_options = $options;
  }


  /**
   * Set the position value automatically when a new sortable object is created
   *
   * @param Doctrine_Event $event
   * @return void
   */
  public function preInsert(Doctrine_Event $event)
  {
    $fieldName = $this->_options['name'];
    $object = $event->getInvoker();
    $object->$fieldName = $object->getFinalPosition()+1;
  }


  /**
   * When a sortable object is deleted, promote all objects positioned lower than itself
   *
   * @param string $Doctrine_Event 
   * @return void
   */  
  public function postDelete(Doctrine_Event $event)
  {
    $fieldName = $this->_options['name'];
    $object = $event->getInvoker();
    $position = $object->$fieldName;

    $q = $object->getTable()->createQuery()
                            ->update(get_class($object))
                            ->set($fieldName, $fieldName . ' - ?', '1')
                            ->where($fieldName . ' > ?', $position)
                            ->orderBy($fieldName);

    foreach ($this->_options['uniqueBy'] as $field)
    {
      $q->addWhere($field . ' = ?', $object[$field]);
    }

    $q->execute();
  }  
  
  /* gemma: quan modifiquem el valor del camp uniqueBy, s'han de recalcular les posicions */
  public function preUpdate(Doctrine_Event $event)
  {
	$object = $event->getInvoker();
	$mod = $object->getModified(true);
	$uniqueByModified = false;
	foreach ($this->_options['uniqueBy'] as $field)
    {
	  if (isset($mod[$field])) { $uniqueByModified = true; }
	}
	if ($uniqueByModified)
	{
		$fieldName = $this->_options['name'];
		$q = $object->getTable()->createQuery()
								->update(get_class($object))
								->set($fieldName, $fieldName . ' - ?', '1')
								->where($fieldName . ' > ?', $object[$fieldName])
								->orderBy($fieldName);

		foreach ($this->_options['uniqueBy'] as $field)
		{
		  if (isset($mod[$field])) $q->addWhere($field . ' = ?', $mod[$field]);
		  else $q->addWhere($field . ' = ?', $object[$field]);
		}
		$this->postUpdateQuery = $q;
		
		$this->preInsert($event);
	}
  }
  
  public function postUpdate(Doctrine_Event $event)
  {
	if (isset($this->postUpdateQuery)) $this->postUpdateQuery->execute();
  }
  /* fi gemma */
  
}