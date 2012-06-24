<?php

/**
 * Users filter form base class.
 *
 * @package    simplenews
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUsersFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'role_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Roles'), 'add_empty' => true)),
      'username' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'password' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'active'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'name'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'surname'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'email'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nickname' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'role_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Roles'), 'column' => 'id')),
      'username' => new sfValidatorPass(array('required' => false)),
      'password' => new sfValidatorPass(array('required' => false)),
      'active'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'name'     => new sfValidatorPass(array('required' => false)),
      'surname'  => new sfValidatorPass(array('required' => false)),
      'email'    => new sfValidatorPass(array('required' => false)),
      'nickname' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('users_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Users';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'role_id'  => 'ForeignKey',
      'username' => 'Text',
      'password' => 'Text',
      'active'   => 'Number',
      'name'     => 'Text',
      'surname'  => 'Text',
      'email'    => 'Text',
      'nickname' => 'Text',
    );
  }
}
