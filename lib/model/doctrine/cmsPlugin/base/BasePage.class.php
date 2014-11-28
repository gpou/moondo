<?php

/**
 * BasePage
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $parent_id
 * @property string $titre
 * @property boolean $visible
 * @property string $submenu_list_class
 * @property string $image
 * @property text $text
 * @property integer $nivells_sub
 * @property Page $Parent
 * @property Doctrine_Collection $SubPages
 * @property Doctrine_Collection $Contents
 * 
 * @method integer             getParentId()           Returns the current record's "parent_id" value
 * @method string              getTitre()              Returns the current record's "titre" value
 * @method boolean             getVisible()            Returns the current record's "visible" value
 * @method string              getSubmenuListClass()   Returns the current record's "submenu_list_class" value
 * @method string              getImage()              Returns the current record's "image" value
 * @method text                getText()               Returns the current record's "text" value
 * @method integer             getNivellsSub()         Returns the current record's "nivells_sub" value
 * @method Page                getParent()             Returns the current record's "Parent" value
 * @method Doctrine_Collection getSubPages()           Returns the current record's "SubPages" collection
 * @method Doctrine_Collection getContents()           Returns the current record's "Contents" collection
 * @method Page                setParentId()           Sets the current record's "parent_id" value
 * @method Page                setTitre()              Sets the current record's "titre" value
 * @method Page                setVisible()            Sets the current record's "visible" value
 * @method Page                setSubmenuListClass()   Sets the current record's "submenu_list_class" value
 * @method Page                setImage()              Sets the current record's "image" value
 * @method Page                setText()               Sets the current record's "text" value
 * @method Page                setNivellsSub()         Sets the current record's "nivells_sub" value
 * @method Page                setParent()             Sets the current record's "Parent" value
 * @method Page                setSubPages()           Sets the current record's "SubPages" collection
 * @method Page                setContents()           Sets the current record's "Contents" collection
 * 
 * @package    moondo
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePage extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('page');
        $this->hasColumn('parent_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('titre', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('visible', 'boolean', null, array(
             'type' => 'boolean',
             'default' => true,
             'notnull' => true,
             ));
        $this->hasColumn('submenu_list_class', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('image', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('text', 'text', null, array(
             'type' => 'text',
             ));
        $this->hasColumn('nivells_sub', 'integer', null, array(
             'type' => 'integer',
             'default' => 2,
             ));

        $this->option('orderBy', 'position');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Page as Parent', array(
             'local' => 'parent_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('Page as SubPages', array(
             'local' => 'id',
             'foreign' => 'parent_id'));

        $this->hasMany('PageContent as Contents', array(
             'local' => 'id',
             'foreign' => 'page_id'));

        $sortable0 = new Doctrine_Template_Sortable(array(
             'uniqueBy' => 
             array(
              0 => 'parent_id',
             ),
             ));
        $i18n0 = new Doctrine_Template_I18n(array(
             'fields' => 
             array(
              0 => 'titre',
              1 => 'text',
             ),
             ));
        $sluggable1 = new Doctrine_Template_Sluggable(array(
             'fields' => 
             array(
              0 => 'titre',
             ),
             'canUpdate' => true,
             'uniqueBy' => 
             array(
              0 => 'lang',
              1 => 'titre',
             ),
             ));
        $i18n0->addChild($sluggable1);
        $this->actAs($sortable0);
        $this->actAs($i18n0);
    }
}