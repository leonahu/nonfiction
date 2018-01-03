<?php

class ClearField extends BaseField {

  static public $assets = array(
    'css' => array(
      'clear.css',
    )
  );

  public function __construct() {
    $this->type = 'clear';
  }

  public function element() {
    $element = new Brick('div');
    $element->addClass('clearline');
    return $element;
  }

}