<?php

/**
 * Comments form base class.
 *
 * @method Comments getObject() Returns the current form's model object
 *
 * @package    simplenews
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCommentsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'user_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Users'), 'add_empty' => false)),
      'text'         => new sfWidgetFormTextarea(),
      'article_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Articles'), 'add_empty' => false)),
      'published_at' => new sfWidgetFormDateTime(),
      'published'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Users'))),
      'text'         => new sfValidatorString(),
      'article_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Articles'))),
      'published_at' => new sfValidatorDateTime(),
      'published'    => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('comments[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Comments';
  }

}
