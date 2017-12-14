<?php
$kirby = kirby();
define("root", __DIR__ . DS);
define("base", "{$kirby->urls->index}/");

// Routes
$kirby->roots->site      = root . 'site';
$kirby->roots->accounts  = root . 'user' . DS . 'accounts';
$kirby->roots->avatars   = root . 'user' . DS . 'avatars';
$kirby->roots->cache     = root . 'user' . DS . 'cache';
$kirby->roots->content   = root . 'user' . DS . 'content';
$kirby->roots->thumbs    = root . 'user' . DS . 'thumbs';
$kirby->roots->assets    = root . 'assets';
$kirby->roots->templates = root . 'site' . DS . 'views';

$kirby->urls->avatars    = base . 'user/avatars';
$kirby->urls->content    = base . 'user/content';
$kirby->urls->thumbs     = base . 'user/thumbs';
$kirby->urls->assets     = base . 'assets';