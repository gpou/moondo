<?php

/**
 * PageContentLink form base class.
 *
 * @method PageContentLink getObject() Returns the current form's model object
 *
 * @package    moondo
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePageContentLinkForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'content_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PageContent'), 'add_empty' => false)),
      'url'        => new sfWidgetFormInputText(),
      'position'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'content_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PageContent'))),
      'url'        => new sfValidatorString(array('max_length' => 255)),
      'position'   => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'PageContentLink', 'column' => array('position', 'content_id')))
    );

    $this->widgetSchema->setNameFormat('page_content_link[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PageContentLink';
  }

}
