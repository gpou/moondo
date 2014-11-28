<?php

/**
 * BaseLlista
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $nom
 * @property string $mail
 * @property text $conegut
 * 
 * @method string getNom()     Returns the current record's "nom" value
 * @method string getMail()    Returns the current record's "mail" value
 * @method text   getConegut() Returns the current record's "conegut" value
 * @method Llista setNom()     Sets the current record's "nom" value
 * @method Llista setMail()    Sets the current record's "mail" value
 * @method Llista setConegut() Sets the current record's "conegut" value
 * 
 * @package    moondo
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLlista extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('llista');
        $this->hasColumn('nom', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('mail', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('conegut', 'text', null, array(
             'type' => 'text',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}