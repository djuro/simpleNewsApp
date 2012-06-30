<?php
class sfCustomTagsWidget extends sfWidgetForm
{
	
 protected function configure($options = array(), $attributes = array())
  {
    $this->addOption('type', 'text');
    $this->setOption('is_hidden', false);
  }


  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    return $this->renderTag('input', array_merge(
      array('type' => $this->getOption('type'), 'name' => $name, 'value' => $value), 
      $attributes
    ));
  }

}