<?php

/**
 * Roles filter form base class.
 *
 * @package    simplenews
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRolesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name' => new sfWidgetFormChoice(array('choices' => array('' => '', 'author' => 'author', 'editor' => 'editor', 'anonymous' => 'anonymous'))),
    ));

    $this->setValidators(array(
      'name' => new sfValidatorChoice(array('required' => false, 'choices' => array('author' => 'author', 'editor' => 'editor', 'anonymous' => 'anonymous'))),
    ));

    $this->widgetSchema->setNameFormat('roles_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Roles';
  }

  public function getFields()
  {
    return array(
      'id'   => 'Number',
      'name' => 'Enum',
    );
  }
}
