<?php

/**
 * Articles filter form base class.
 *
 * @package    simplenews
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseArticlesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'text'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'category_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Categories'), 'add_empty' => true)),
      'published_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'read_count'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'user_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Users'), 'add_empty' => true)),
      'published'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'photo'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tags_list'    => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Tags')),
    ));

    $this->setValidators(array(
      'title'        => new sfValidatorPass(array('required' => false)),
      'text'         => new sfValidatorPass(array('required' => false)),
      'category_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Categories'), 'column' => 'id')),
      'published_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'read_count'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'user_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Users'), 'column' => 'id')),
      'published'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'photo'        => new sfValidatorPass(array('required' => false)),
      'tags_list'    => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Tags', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('articles_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addTagsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.ArticlesTags ArticlesTags')
      ->andWhereIn('ArticlesTags.tags_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Articles';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'title'        => 'Text',
      'text'         => 'Text',
      'category_id'  => 'ForeignKey',
      'published_at' => 'Date',
      'read_count'   => 'Number',
      'user_id'      => 'ForeignKey',
      'published'    => 'Number',
      'photo'        => 'Text',
      'tags_list'    => 'ManyKey',
    );
  }
}
