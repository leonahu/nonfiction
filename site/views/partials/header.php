<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
  <meta name="description" content="<?php echo $page->metadescription()->html() ?>">
  <title><?php echo $o->title ?></title>

  <link rel="icon" href="<?php echo b::asset($o->tree['imgs']['favico']) ?>" type="image/x-icon"> 
  <link rel="shortcut icon" href="<?php echo b::asset($o->tree['imgs']['favico']) ?>" type="image/x-icon">
  <link rel="apple-touch-icon" sizes="57x57" href="<?php echo b::asset($o->tree['imgs']['favico57']) ?>">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php echo b::asset($o->tree['imgs']['favico72']) ?>">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php echo b::asset($o->tree['imgs']['favico114']) ?>">
  <link rel="apple-touch-icon" sizes="144x144" href="<?php echo b::asset($o->tree['imgs']['favico144']) ?>">

  <meta property="og:title" content="<?php echo $o->title ?>">
  <meta property="og:url" content="<?php echo $page->url() ?>">
  <meta property="og:type" content="website">
  <meta property="og:image" content="<?php echo b::asset($o->tree['imgs']['og-1200']) ?>">
  <meta property="og:description" content="<?php echo $page->metadescription()->html() ?>">

  <?php echo b::css($o->tree['css']['mustache']) . b::css($o->tree['css']) ?>
  <?php b::fonts(
    ["Crimson Text", b::asset($o->tree['fonts']['Crimson Text-400']), '400'],
    ["Crimson Text", b::asset($o->tree['fonts']['Crimson Text-600']), '600'],
    ["Noto Sans", b::asset($o->tree['fonts']['Noto Sans-400']), '400'],
    ["Noto Sans", b::asset($o->tree['fonts']['Noto Sans-700']), '700']
  ) ?>
</head>
<body class="<?php echo $o->class ?>">


<nav class="nav1" role="navigation">
  <div class="box">
    <div class="navbg"></div>
    <ul>
      <li><a href='#' class='link'>About</a></li><!--
    --><li><a class="logo" href="/"><img src="<?php echo b::asset($o->tree['imgs']['logo'])?>" alt="Nonfiction" /></a></li><!--
    --><li><a href='#' class='link'>Contact</a></li>
    </ul>
  </div>
</nav>


<nav class="nav2" role="navigation">
  <div class="box">
    <div class="navbg"></div>
    <ul>
      <li><a href='#' class='link'>Clients</a></li><!--
    --><li><a href='#' class='link'>Work</a></li><!--
    --><li><a href='#' class='link'>FAQ</a></li>
    </ul>
  </div>
</nav>