<?php

// Called on kirby launch.
define('domain', $_SERVER['HTTP_HOST']);
$_SERVER['SERVER_NAME'] = $_SERVER['HTTP_HOST']; // nginx..

// Environment configurations.
if (domain == 'non.rickyboyce.me') {
  define('debug', true);
  define('cache', false);
  define("build", false); 
  define("cdn", false);
  define("bust", false);
  define("versioning", true);

} else {
  define('debug', false);
  define('cache', true);
  define("build", true);
  define("cdn", false);
  define("bust", false);
  define("versioning", true);
}

// Project variables.
define("assetssource", 'assets/');
define("assetsbuild", 'assets/.tmp/');

// Kirby configurations.
c::set('license', 'put your license key here');
c::set('debug', debug);
c::set('cache', cache);
c::set('kirbytext.filters', array());
c::set('panel.stylesheet', 'assets/css/admin.css');

// Routes.
c::set('routes', [
  [
    // JSON views.
    'pattern' => ["view(:all)"],
    'action' => function($path) {
      define('jview', true);
      $page = page($path == '/'? 'home' : $path);
      if (!$page) return new Response('{}', 'json', 404);
      return $page;
    }
  ],[
    // All other pages.
    'pattern' => ["(/)", "(:all)"],
    'action' => function($path) {
      define('jview', false);
      $page = page($path == '/'? 'home' : $path);
      if (!$page) $page = site()->errorPage();
      return $page;
    }
  ]
]);