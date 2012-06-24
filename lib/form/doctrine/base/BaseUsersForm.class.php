<?php

/**
 * Users form base class.
 *
 * @method Users getObject() Returns the current form's model object
 *
 * @package    simplenews
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUsersForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'role_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Roles'), 'add_empty' => false)),
      'username' => new sfWidgetFormInputText(),
      'password' => new sfWidgetFormInputText(),
      'active'   => new sfWidgetFormInputText(),
      'name'     => new sfWidgetFormInputText(),
      'surname'  => new sfWidgetFormInputText(),
      'email'    => new sfWidgetFormInputText(),
      'nickname' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'role_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Roles'))),
      'username' => new sfValidatorString(array('max_length' => 60)),
      'password' => new sfValidatorString(array('max_length' => 90)),
      'active'   => new sfValidatorInteger(),
      'name'     => new sfValidatorString(array('max_length' => 50)),
      'surname'  => new sfValidatorString(array('max_length' => 80)),
      'email'    => new sfValidatorString(array('max_length' => 60)),
      'nickname' => new sfValidatorString(array('max_length' => 60)),
    ));

    $this->widgetSchema->setNameFormat('users[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Users';
  }

}
