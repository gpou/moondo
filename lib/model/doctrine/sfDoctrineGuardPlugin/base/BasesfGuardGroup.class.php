<?php

/**
 * BasesfGuardGroup
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property string $description
 * @property Doctrine_Collection $Users
 * @property Doctrine_Collection $Permissions
 * @property Doctrine_Collection $sfGuardGroupPermission
 * @property Doctrine_Collection $sfGuardUserGroup
 * 
 * @method string              getName()                   Returns the current record's "name" value
 * @method string              getDescription()            Returns the current record's "description" value
 * @method Doctrine_Collection getUsers()                  Returns the current record's "Users" collection
 * @method Doctrine_Collection getPermissions()            Returns the current record's "Permissions" collection
 * @method Doctrine_Collection getSfGuardGroupPermission() Returns the current record's "sfGuardGroupPermission" collection
 * @method Doctrine_Collection getSfGuardUserGroup()       Returns the current record's "sfGuardUserGroup" collection
 * @method sfGuardGroup        setName()                   Sets the current record's "name" value
 * @method sfGuardGroup        setDescription()            Sets the current record's "description" value
 * @method sfGuardGroup        setUsers()                  Sets the current record's "Users" collection
 * @method sfGuardGroup        setPermissions()            Sets the current record's "Permissions" collection
 * @method sfGuardGroup        setSfGuardGroupPermission() Sets the current record's "sfGuardGroupPermission" collection
 * @method sfGuardGroup        setSfGuardUserGroup()       Sets the current record's "sfGuardUserGroup" collection
 * 
 * @package    moondo
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasesfGuardGroup extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sf_guard_group');
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'unique' => true,
             'length' => 255,
             ));
        $this->hasColumn('description', 'string', 1000, array(
             'type' => 'string',
             'length' => 1000,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('sfGuardUser as Users', array(
             'refClass' => 'sfGuardUserGroup',
             'local' => 'group_id',
             'foreign' => 'user_id'));

        $this->hasMany('sfGuardPermission as Permissions', array(
             'refClass' => 'sfGuardGroupPermission',
             'local' => 'group_id',
             'foreign' => 'permission_id'));

        $this->hasMany('sfGuardGroupPermission', array(
             'local' => 'id',
             'foreign' => 'group_id'));

        $this->hasMany('sfGuardUserGroup', array(
             'local' => 'id',
             'foreign' => 'group_id'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}