<?php

/**
 * BasePageContent
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $page_id
 * @property enum $type
 * @property enum $users
 * @property text $text
 * @property boolean $visible
 * @property integer $submenu_levels
 * @property Page $Page
 * @property Doctrine_Collection $Images
 * @property Doctrine_Collection $Videos
 * @property Doctrine_Collection $Audios
 * @property Doctrine_Collection $Docs
 * @property Doctrine_Collection $Links
 * 
 * @method integer             getPageId()         Returns the current record's "page_id" value
 * @method enum                getType()           Returns the current record's "type" value
 * @method enum                getUsers()          Returns the current record's "users" value
 * @method text                getText()           Returns the current record's "text" value
 * @method boolean             getVisible()        Returns the current record's "visible" value
 * @method integer             getSubmenuLevels()  Returns the current record's "submenu_levels" value
 * @method Page                getPage()           Returns the current record's "Page" value
 * @method Doctrine_Collection getImages()         Returns the current record's "Images" collection
 * @method Doctrine_Collection getVideos()         Returns the current record's "Videos" collection
 * @method Doctrine_Collection getAudios()         Returns the current record's "Audios" collection
 * @method Doctrine_Collection getDocs()           Returns the current record's "Docs" collection
 * @method Doctrine_Collection getLinks()          Returns the current record's "Links" collection
 * @method PageContent         setPageId()         Sets the current record's "page_id" value
 * @method PageContent         setType()           Sets the current record's "type" value
 * @method PageContent         setUsers()          Sets the current record's "users" value
 * @method PageContent         setText()           Sets the current record's "text" value
 * @method PageContent         setVisible()        Sets the current record's "visible" value
 * @method PageContent         setSubmenuLevels()  Sets the current record's "submenu_levels" value
 * @method PageContent         setPage()           Sets the current record's "Page" value
 * @method PageContent         setImages()         Sets the current record's "Images" collection
 * @method PageContent         setVideos()         Sets the current record's "Videos" collection
 * @method PageContent         setAudios()         Sets the current record's "Audios" collection
 * @method PageContent         setDocs()           Sets the current record's "Docs" collection
 * @method PageContent         setLinks()          Sets the current record's "Links" collection
 * 
 * @package    moondo
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePageContent extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('page_content');
        $this->hasColumn('page_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('type', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'text',
              1 => 'images',
              2 => 'videos',
              3 => 'audios',
              4 => 'docs',
              5 => 'links',
              6 => 'form',
              7 => 'submenu',
             ),
             'notnull' => true,
             'default' => 'text',
             ));
        $this->hasColumn('users', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'tots',
              1 => 'llista',
             ),
             'default' => 'tots',
             'notnull' => true,
             ));
        $this->hasColumn('text', 'text', null, array(
             'type' => 'text',
             ));
        $this->hasColumn('visible', 'boolean', null, array(
             'type' => 'boolean',
             'default' => true,
             'notnull' => true,
             ));
        $this->hasColumn('submenu_levels', 'integer', null, array(
             'type' => 'integer',
             ));

        $this->option('orderBy', 'position');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Page', array(
             'local' => 'page_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('PageContentImage as Images', array(
             'local' => 'id',
             'foreign' => 'content_id'));

        $this->hasMany('PageContentVideo as Videos', array(
             'local' => 'id',
             'foreign' => 'content_id'));

        $this->hasMany('PageContentAudio as Audios', array(
             'local' => 'id',
             'foreign' => 'content_id'));

        $this->hasMany('PageContentDoc as Docs', array(
             'local' => 'id',
             'foreign' => 'content_id'));

        $this->hasMany('PageContentLink as Links', array(
             'local' => 'id',
             'foreign' => 'content_id'));

        $sortable0 = new Doctrine_Template_Sortable(array(
             'uniqueBy' => 
             array(
              0 => 'page_id',
             ),
             ));
        $i18n0 = new Doctrine_Template_I18n(array(
             'fields' => 
             array(
              0 => 'text',
             ),
             ));
        $this->actAs($sortable0);
        $this->actAs($i18n0);
    }
}