<?php

/**
 * BasePageContentVideo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $content_id
 * @property string $image_small
 * @property string $url
 * @property string $titre
 * @property PageContent $PageContent
 * 
 * @method integer          getContentId()   Returns the current record's "content_id" value
 * @method string           getImageSmall()  Returns the current record's "image_small" value
 * @method string           getUrl()         Returns the current record's "url" value
 * @method string           getTitre()       Returns the current record's "titre" value
 * @method PageContent      getPageContent() Returns the current record's "PageContent" value
 * @method PageContentVideo setContentId()   Sets the current record's "content_id" value
 * @method PageContentVideo setImageSmall()  Sets the current record's "image_small" value
 * @method PageContentVideo setUrl()         Sets the current record's "url" value
 * @method PageContentVideo setTitre()       Sets the current record's "titre" value
 * @method PageContentVideo setPageContent() Sets the current record's "PageContent" value
 * 
 * @package    moondo
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePageContentVideo extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('page_content_video');
        $this->hasColumn('content_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('image_small', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('url', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('titre', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));

        $this->option('orderBy', 'position');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('PageContent', array(
             'local' => 'content_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $sortable0 = new Doctrine_Template_Sortable(array(
             'uniqueBy' => 
             array(
              0 => 'content_id',
             ),
             ));
        $i18n0 = new Doctrine_Template_I18n(array(
             'fields' => 
             array(
              0 => 'titre',
             ),
             ));
        $this->actAs($sortable0);
        $this->actAs($i18n0);
    }
}