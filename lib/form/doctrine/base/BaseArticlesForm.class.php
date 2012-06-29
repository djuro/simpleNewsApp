<?php

/**
 * Articles form base class.
 *
 * @method Articles getObject() Returns the current form's model object
 *
 * @package    simplenews
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArticlesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'title'        => new sfWidgetFormInputText(),
      'text'         => new sfWidgetFormTextarea(),
      'category_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Categories'), 'add_empty' => false)),
      'published_at' => new sfWidgetFormDateTime(),
      'read_count'   => new sfWidgetFormInputText(),
      'user_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Users'), 'add_empty' => false)),
      'published'    => new sfWidgetFormInputText(),
      'photo'        => new sfWidgetFormInputText(),
      'tags_list'    => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Tags')),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'title'        => new sfValidatorString(array('max_length' => 180)),
      'text'         => new sfValidatorString(),
      'category_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Categories'))),
      'published_at' => new sfValidatorDateTime(),
      'read_count'   => new sfValidatorInteger(),
      'user_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Users'))),
      'published'    => new sfValidatorInteger(),
      'photo'        => new sfValidatorString(array('max_length' => 255)),
      'tags_list'    => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Tags', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('articles[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Articles';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['tags_list']))
    {
      $this->setDefault('tags_list', $this->object->Tags->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveTagsList($con);

    parent::doSave($con);
  }

  public function saveTagsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['tags_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Tags->getPrimaryKeys();
    $values = $this->getValue('tags_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Tags', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Tags', array_values($link));
    }
  }

}
