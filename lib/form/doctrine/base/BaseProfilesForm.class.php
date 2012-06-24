<?php

/**
 * Profiles form base class.
 *
 * @method Profiles getObject() Returns the current form's model object
 *
 * @package    simplenews
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProfilesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'name'     => new sfWidgetFormInputText(),
      'surname'  => new sfWidgetFormInputText(),
      'nickname' => new sfWidgetFormInputText(),
      'email'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'     => new sfValidatorString(array('max_length' => 50)),
      'surname'  => new sfValidatorString(array('max_length' => 80)),
      'nickname' => new sfValidatorString(array('max_length' => 20)),
      'email'    => new sfValidatorString(array('max_length' => 60)),
    ));

    $this->widgetSchema->setNameFormat('profiles[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Profiles';
  }

}
