<?php

/**
 * Articles form.
 *
 * @package    simplenews
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ArticlesForm extends BaseArticlesForm
{
  public function configure()
  {

  	//$this->form = new sfForm();
    $this->setWidgets(array(
  'title'    => new sfWidgetFormInput(array('label' => 'Article title'), array('size' => 25, 'class' => 'foo')),
  'text'   => new sfWidgetFormTextarea(array('default' => '', 'label' => 'Text'), array('onclick' => 'this.value = "";')),
  'category_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Categories'), 'add_empty' => false)),
  'published' => new sfWidgetFormChoice(array('choices' => array('0', '1'))),
  'user_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Users'), 'add_empty' => false)),
  'photo' => new sfWidgetFormInputFile(),
  'tags' => new sfWidgetFormInput(),
));


    $this->setValidators(array(
      'title'           => new sfValidatorString(),
      'text'        => new sfValidatorString(),
      'category_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Categories'))),
      'published'         => new sfValidatorInteger(),
      'user_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Users'))),
      'photo'  => new sfValidatorFile(array('max_size' =>'512000',
                                            'mime_types' => 'web_images', //you can set your own of course
	                                        'path'       => sfConfig::get('sf_upload_dir'),
	                                        'required' => false
	                                        )),
      'tags'  => new sfValidatorString(),
      ));


    $this->widgetSchema->setNameFormat('articles[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();


  }

  
}
