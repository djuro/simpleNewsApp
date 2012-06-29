<?php

/**
 * Tags form base class.
 *
 * @method Tags getObject() Returns the current form's model object
 *
 * @package    simplenews
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTagsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'text'          => new sfWidgetFormInputText(),
      'articles_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Articles')),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'text'          => new sfValidatorString(array('max_length' => 255)),
      'articles_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Articles', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tags[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tags';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['articles_list']))
    {
      $this->setDefault('articles_list', $this->object->Articles->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveArticlesList($con);

    parent::doSave($con);
  }

  public function saveArticlesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['articles_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Articles->getPrimaryKeys();
    $values = $this->getValue('articles_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Articles', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Articles', array_values($link));
    }
  }

}
