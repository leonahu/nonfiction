<html>
<head>
  <!-- Developed by Ricky Boyce : rickyboyce.com -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
  <meta name="description" content="<?php echo $page->metadescription() ?>">
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
  <meta property="og:description" content="<?php echo $page->metadescription() ?>">

  <?php echo b::css($o->tree, ['css', 'mustache']) . b::css($o->tree, ['css']) ?>
  <?php //<link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,600|Noto+Sans:400,700" rel="stylesheet">?>
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
      <li><a href='/about' class='link'>About<?php echo b::x() ?></a></li><!--
    --><li><a class="logo" href="/">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -2 246 27">
          <path d="M70.007 15.09L59.107-.103h-6.046v25.07h5.989V10.049l10.865 14.918h6.093V-.103h-6.037l.036 15.193zm38.035 9.877l6.921-.018V-.12l-6.921.017v25.07zm-24.019 0h6.005v-8.941h10.971v-5.174H90.028V4.986h11.907l.036-5.09H84.023v25.071zm54.147-6.662c-1.127.527-2.207.793-3.24.793-1.271 0-2.43-.318-3.473-.955-1.045-.635-1.867-1.512-2.467-2.627-.6-1.117-.9-2.359-.9-3.727 0-1.369.301-2.611.9-3.727.6-1.116 1.422-1.992 2.467-2.629 1.043-.635 2.201-.953 3.473-.953 1.105 0 2.221.306 3.348.918 1.129.611 2.102 1.434 2.916 2.466l3.816-4.608C143.739 1.912 142.19.85 140.367.07c-1.824-.78-3.674-1.17-5.545-1.17-2.545 0-4.842.564-6.895 1.691-2.051 1.129-3.666 2.676-4.841 4.645-1.176 1.968-1.764 4.176-1.764 6.625 0 2.471.576 4.703 1.728 6.695 1.152 1.992 2.736 3.564 4.752 4.717S132.074 25 134.57 25c1.848 0 3.715-.426 5.598-1.277 1.885-.852 3.51-1.998 4.879-3.438l-3.854-4.141c-.886.913-1.894 1.633-3.023 2.161zM17.061 15.09L5.827-.104H.031v25.049H6.02V10.049l11.364 14.896h5.635V-.104h-5.995l.037 15.194zM239.965-.104L240 15.09 228.182-.104h-6.127v25.07h6.072V10.049l11.863 14.918H246V-.103h-6.035zm-30.533.696c-2.076-1.127-4.396-1.691-6.965-1.691s-4.891.564-6.967 1.691c-2.076 1.129-3.707 2.676-4.896 4.645-1.188 1.968-1.781 4.176-1.781 6.625 0 2.471.594 4.709 1.781 6.713 1.189 2.004 2.82 3.576 4.896 4.717S199.898 25 202.467 25s4.889-.574 6.965-1.727 3.709-2.725 4.896-4.717 1.781-4.225 1.781-6.695c0-2.449-.594-4.657-1.781-6.625-1.187-1.968-2.82-3.515-4.896-4.644zm-.991 15.078c-.6 1.141-1.422 2.041-2.465 2.699-1.045.66-2.189.99-3.438.99s-2.4-.33-3.457-.99c-1.057-.658-1.902-1.559-2.537-2.699-.637-1.141-.955-2.406-.955-3.799 0-1.367.313-2.621.936-3.762.625-1.141 1.471-2.034 2.539-2.682 1.068-.648 2.227-.973 3.475-.973s2.393.324 3.438.973c1.043.647 1.865 1.541 2.465 2.682.602 1.141.9 2.395.9 3.762 0 1.393-.299 2.658-.901 3.799zm-59.365-9.754h7.07v19.051h6.588V5.916h7.227v-6.02h-20.885v6.02zm26.883 19.051h7.004V-.103h-7.004v25.07zM43.48 3.029l-5.558 5.559-5.559-5.559-5.222 5.223L32.7 13.81l-5.558 5.56 5.222 5.223 5.559-5.559 5.558 5.559 5.222-5.223-5.558-5.56 5.558-5.558-5.223-5.223z"/>
        </svg>
      </a></li><!--
    --><li><a href='#' class='link cbtn leftx'><?php echo b::x() ?>Contact</a></li>
    </ul>
  </div>
</nav>


<nav class="nav2" role="navigation">
  <div class="box">
    <div class="navbg"></div>
    <ul>
      <li><a href='/clients' class='link'>Clients<?php echo b::x() ?></a></li><!--
    --><li><a href='/projects' class='link'>Work<?php echo b::x() ?></a></li><!--
    --><li><a href='/faq' class='link leftx'><?php echo b::x() ?>FAQ</a></li>
    </ul>
  </div>
</nav>


<div class="mobileham">
  <div class="box">
    <div>
      <span href="#" class="ham1">
        <em>
          <span class="one"></span>
          <span class="two"></span>
          <span class="three"></span>
        </em>
      </span>

      <div class="logomobile">
        <a class="logo" href="/">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -2 246 27">
            <path d="M70.007 15.09L59.107-.103h-6.046v25.07h5.989V10.049l10.865 14.918h6.093V-.103h-6.037l.036 15.193zm38.035 9.877l6.921-.018V-.12l-6.921.017v25.07zm-24.019 0h6.005v-8.941h10.971v-5.174H90.028V4.986h11.907l.036-5.09H84.023v25.071zm54.147-6.662c-1.127.527-2.207.793-3.24.793-1.271 0-2.43-.318-3.473-.955-1.045-.635-1.867-1.512-2.467-2.627-.6-1.117-.9-2.359-.9-3.727 0-1.369.301-2.611.9-3.727.6-1.116 1.422-1.992 2.467-2.629 1.043-.635 2.201-.953 3.473-.953 1.105 0 2.221.306 3.348.918 1.129.611 2.102 1.434 2.916 2.466l3.816-4.608C143.739 1.912 142.19.85 140.367.07c-1.824-.78-3.674-1.17-5.545-1.17-2.545 0-4.842.564-6.895 1.691-2.051 1.129-3.666 2.676-4.841 4.645-1.176 1.968-1.764 4.176-1.764 6.625 0 2.471.576 4.703 1.728 6.695 1.152 1.992 2.736 3.564 4.752 4.717S132.074 25 134.57 25c1.848 0 3.715-.426 5.598-1.277 1.885-.852 3.51-1.998 4.879-3.438l-3.854-4.141c-.886.913-1.894 1.633-3.023 2.161zM17.061 15.09L5.827-.104H.031v25.049H6.02V10.049l11.364 14.896h5.635V-.104h-5.995l.037 15.194zM239.965-.104L240 15.09 228.182-.104h-6.127v25.07h6.072V10.049l11.863 14.918H246V-.103h-6.035zm-30.533.696c-2.076-1.127-4.396-1.691-6.965-1.691s-4.891.564-6.967 1.691c-2.076 1.129-3.707 2.676-4.896 4.645-1.188 1.968-1.781 4.176-1.781 6.625 0 2.471.594 4.709 1.781 6.713 1.189 2.004 2.82 3.576 4.896 4.717S199.898 25 202.467 25s4.889-.574 6.965-1.727 3.709-2.725 4.896-4.717 1.781-4.225 1.781-6.695c0-2.449-.594-4.657-1.781-6.625-1.187-1.968-2.82-3.515-4.896-4.644zm-.991 15.078c-.6 1.141-1.422 2.041-2.465 2.699-1.045.66-2.189.99-3.438.99s-2.4-.33-3.457-.99c-1.057-.658-1.902-1.559-2.537-2.699-.637-1.141-.955-2.406-.955-3.799 0-1.367.313-2.621.936-3.762.625-1.141 1.471-2.034 2.539-2.682 1.068-.648 2.227-.973 3.475-.973s2.393.324 3.438.973c1.043.647 1.865 1.541 2.465 2.682.602 1.141.9 2.395.9 3.762 0 1.393-.299 2.658-.901 3.799zm-59.365-9.754h7.07v19.051h6.588V5.916h7.227v-6.02h-20.885v6.02zm26.883 19.051h7.004V-.103h-7.004v25.07zM43.48 3.029l-5.558 5.559-5.559-5.559-5.222 5.223L32.7 13.81l-5.558 5.56 5.222 5.223 5.559-5.559 5.558 5.559 5.222-5.223-5.558-5.56 5.558-5.558-5.223-5.223z"/>
          </svg>
        </a>
      </div>
    </div>
  </div>
</div>


<nav class="mobilenav" role="navigation">
  <div class="box">
    <div class="navbg"></div>
    <ul>
      <li><a href='/about' class='link'>About</a></li><!--
    --><li><a href='#' class='link cbtn'>Contact</a></li><!--
    --><li><a href='/clients' class='link'>Clients</a></li><!--
    --><li><a href='/projects' class='link'>Work</a></li><!--
    --><li><a href='/faq' class='link'>FAQ</a></li>
    </ul>
  </div>
</nav>


<div class="contact">
  <div>
    <div>
      <div class="bg cbtn"></div>
      <div class="cbox">
        <div class='closebox cbtn'><div class='close'><b></b><b></b></div></div>
        <h2><?php echo $site->contactheading() ?></h2>
        <?php echo multiline($site->contact()->qt()) ?>
      </div>
    </div>
  </div>
</div>