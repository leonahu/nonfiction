<?php

class InfoField extends BaseField {

  public $text;
  public $class;

  public function result() {
    return null;
  }

  public function element() {
    $element = parent::element();
    $element->addClass('field-with-icon');
    if ($this->class) $element->addClass($this->class);
    return $element;
  }

  public function input() {
    return '<div class="text">' . kirbytext($this->i18n($this->text())) . '</div>';
  }

}