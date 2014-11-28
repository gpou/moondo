<?php

/**
 * PageContent form base class.
 *
 * @method PageContent getObject() Returns the current form's model object
 *
 * @package    moondo
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePageContentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'page_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Page'), 'add_empty' => false)),
      'type'           => new sfWidgetFormChoice(array('choices' => array('text' => 'text', 'images' => 'images', 'videos' => 'videos', 'audios' => 'audios', 'docs' => 'docs', 'links' => 'links', 'form' => 'form', 'submenu' => 'submenu'))),
      'users'          => new sfWidgetFormChoice(array('choices' => array('tots' => 'tots', 'llista' => 'llista'))),
      'visible'        => new sfWidgetFormInputCheckbox(),
      'submenu_levels' => new sfWidgetFormInputText(),
      'position'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'page_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Page'))),
      'type'           => new sfValidatorChoice(array('choices' => array(0 => 'text', 1 => 'images', 2 => 'videos', 3 => 'audios', 4 => 'docs', 5 => 'links', 6 => 'form', 7 => 'submenu'), 'required' => false)),
      'users'          => new sfValidatorChoice(array('choices' => array(0 => 'tots', 1 => 'llista'), 'required' => false)),
      'visible'        => new sfValidatorBoolean(array('required' => false)),
      'submenu_levels' => new sfValidatorInteger(array('required' => false)),
      'position'       => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'PageContent', 'column' => array('position', 'page_id')))
    );

    $this->widgetSchema->setNameFormat('page_content[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PageContent';
  }

}
