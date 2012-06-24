<?php
class ContactForm extends sfForm
{
  protected static $subjects = array('Subject A', 'Subject B', 'Subject C');
 
  public function configure()
  {
    $this->widgetSchema->setNameFormat('contact[%s]');
    $this->widgetSchema->setIdFormat('my_form_%s');
    $this->setWidgets(array(
      'name'    => new sfWidgetFormInputText(),
      'email'   => new sfWidgetFormInput(array('default' => 'me@example.com')),
      'subject' => new sfWidgetFormChoice(array('choices' => array('Subject A', 'Subject B', 'Subject C'))),
      'message' => new sfWidgetFormTextarea(),
    ));
    $this->setValidators(array(
      'name'    => new sfValidatorString(),
      'email'   => new sfValidatorEmail(),
      'subject' => new sfValidatorString(),
      'message' => new sfValidatorString(array('min_length' => 4))
    ));
    $this->setDefaults(array(
      'email' => 'me@example.com'
    ));
  }
}