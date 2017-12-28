<?php

/**
 *  Uploads : Adds CDN and php versioning.
 *  Assets  : Adds CDN and build path.
 *  Hassles : Tell client to rename uploads if file change.
 *  Todo    : Need to parse kirbytext to add php versioning / cdn
 *            to all relative / local urls.
 */

// Kirbytext extension.
class kirbytextExtended extends kirbytext {
  function __construct($text, $markdown=true) {
    parent::__construct($text, $markdown);
    // define the custom 'more' tag
    $this->addTags('more');
  }
  // define that the 'more' tag returns nothing
  function more($params) {
    return ("");
  }
}

// Helpers.
class b {

public static function asset($url) {
  /**
   * Get the augmented url with cdn and versioning.
   * @param url path.
   * @return string.
   */

  // Tree asset.
  if (!preg_match("/user\/content/", $url))
    return cdn1 . $url;

  // Uploaded file.
  $uri = preg_replace('/^(https?:\/\/)?([^\/?#]*)?\/(.*)/', '$3', $url);
  $rooturi = root . $uri;

  // File exists.
  $info = pathinfo($rooturi);
  if (is_file($rooturi) && versioning && preg_match('/js|css|png|jpg|jpeg|gif/', $info['extension']))
    return cdn1 . str_replace($info['extension'], filemtime($rooturi) . '.' . $info['extension'], $uri);
  
  return cdn1 . $uri;
}

public static function css($base, $dirs, $media = null) {

  // Force an array.
  $css = array();
  $urls = $base;
  foreach ($dirs as $d) {
    if (!isset($urls[$d])) return '';
    $urls = $urls[$d];
  }

  // Normalaize strings into [].
  if (!is_array($urls)) $urls = [$urls];

  // Add urls
  foreach ($urls as $url) {
    if (!is_string($url)) continue;
    $css[] = html::tag('link', null, array(
      'rel'   => 'stylesheet',
      'href'  => cdn1 . $url . (bust? '?' . time() : ''),
      'media' => $media
    ));
  }

  return implode(PHP_EOL, $css) . (count($css) > 1? PHP_EOL : '');
}

public static function exists($o) {
  /**
   * Checks if files exists.
   * @param $o: takes kirby file.
   * @return boolean.
   */

  if ($o->exists() && !$o->empty()) return true;
  else return false;
}

public static function fonts($link = false) {
  /**
   * Return fonts.
   * @param array(name, path, weight, style), ..
   * @link http://docs.me/fonts
   * @link https://google-webfonts-helper.herokuapp.com
   */

  if (!$link) return;
  $fonts = func_get_args();
  $wantlink  = $link == 1? true : false;
  $lastname = false;
  $s = "";

  // If requesting the link method.
  if ($wantlink) {
    $s .= "<link href='https://fonts.googleapis.com/css?family=";

    // Loop through fonts
    for ($i=1, $l=count($fonts); $i<$l; $i++) {
      $name   = str_replace(" ", "+", $fonts[$i][0]);
      $weight = isset($fonts[$i][2])? $fonts[$i][2] : 400;
      $style  = isset($fonts[$i][3])? $fonts[$i][3] : "";

      // Append weight/style
      if ($lastname == $name) $s .= ",{$weight}{$style}";

      // First font
      elseif (!$lastname) $s .= "{$name}:{$weight}{$style}";

      // New font
      else $s .= "|{$name}:{$weight}{$style}";
      $lastname = $name;
    }
    
    echo "{$s}' rel='stylesheet' type='text/css'>";
    return;
  }

  // Loop through fonts
  for ($i=0, $l=count($fonts); $i<$l; $i++) {
    $name    = $fonts[$i][0];
    $nameMin = str_replace(" ", "", $name);
    $url     = preg_replace("/\\.[^.\\s]{3,5}$/", "", $fonts[$i][1]);
    $weight  = (isset($fonts[$i][2])) ? $fonts[$i][2] : 400;
    $style   = (isset($fonts[$i][3])) ? $fonts[$i][3] : "normal";

    // Find weight name
    if ($weight == 300) $weight2 = 'Light';
    if ($weight == 600) $weight2 = 'Semibold';
    if ($weight == 700) $weight2 = 'Bold';
    if ($weight == 800) $weight2 = 'Extrabold';
    else $weight2 = '';

    $weightstyle = $weight2 . ($style=='normal'? '' : ' ' . ucfirst($style));
    $weightstyle2 = str_replace(' ', '', $weightstyle);

    $local1 = $weightstyle2? $name . ' ' . $weightstyle : $name; 
    $local2 = $weightstyle2? $nameMin . '-' . $weightstyle2 : $nameMin; 

    $s .= "@font-face {
      font-family: '{$name}';
      font-weight: $weight;
      font-style: $style;
      src: url('{$url}.eot');
      src: local({$local1}), local({$local2}),
      url('{$url}.eot?#iefix') format('eot'),
      url('{$url}.woff2') format('woff2'),
      url('{$url}.woff') format('woff'),
      url('{$url}.ttf') format('truetype'),
      url('{$url}.svg#{$nameMin}') format('svg');
    }";

  }

  $s = preg_replace("/\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~+-])\s*+|([[(:])\s++|\s++([])])/", "$1$2$3$4", $s);
  echo "<style type='text/css'>" . $s . "</style>";
}

public static function html($text) {
  // Update all links
  //$text = preg_replace_callback("/(?<=href=(\"|'))[^\"']+(?=(\"|'))/", "_replacelink", $text);
  // Remove leading ((more))
  $text = preg_replace("/[\s\n\r]*(<p>)*\(\(\s*more\s*\)\)(<\/p>)*/", "", $text);
  // Remove surrounding p on <figure>.
  $text = preg_replace("/<p>(<figure>(<a[^>]*>)?<img[^>]*>(<\/a>)?<\/figure>)(<br>)*<\/p>/", "$1", $text);

  return $text;
}

public static function js($base, $dirs, $async = false) {

  // Force an array.
  $js = array();
  $urls = $base;
  foreach ($dirs as $d) {
    if (!isset($urls[$d])) return '';
    $urls = $urls[$d];
  }

  // Normalaize strings into [].
  if (!is_array($urls)) $urls = [$urls];

  foreach ($urls as $url) {
    if (!is_string($url)) continue;
    $js[] = html::tag('script', '', array(
      'src'   => cdn1 . $url . (bust? '?' . time() : ''),
      'async' => $async
    ));
  }

  return implode(PHP_EOL, $js) . (count($js) > 1? PHP_EOL : '');
}

public static function len($field) {
  /**
   * Not sure if this is used
   */

  // Remove non breaking spaces
  $stripped = preg_replace('/&nbsp;/', '', $field->excerpt());

  // Just whitespaces?
  preg_match("/^\s*$/", $stripped, $matches);
  
  return (count($matches) > 0 || $stripped == '')? false : true;
}

public static function replacelink($matches) {

  return u($matches[0]);
}

public static function title($page) {
  return $page->title() == 'Home'? $page->metatitle()->value()
    : ($page->metatitle()->value() . " : Nonfiction");// . $site->tagname()->value());
}

}