<?php 

// --- Configurations -------------------
if (preg_match("/localhost/i", $_SERVER['HTTP_HOST'])) {
  define('prod', false);
  define('debug', true);
  define('cache', false);
  define("build", false); 
  define("cdn", false);
  define("bust", false);

} else {
  define('prod', true);
  define('debug', true);
  define('cache', true);
  define("build", true);
  define("cdn", true);
  define("bust", false);//time()
}

define('_s', 57);
define("assetssource", 'assets/');
define("assetsbuild", 'assets/.tmp/');
define('sender_host', 'rickyboyce.com');

// --- Environment Logic ----------------

global $kirby;
global $site;
define('host', $_SERVER['HTTP_HOST'] . '/');
define('cdn1', (cdn? '//cdn1.' : '//') . host);
define('cdn2', (cdn? '//cdn2.' : '//') . host);
define('http', isset($_SERVER['HTTPS'])? "https://" : "http://");
define('url', http . host . $_SERVER['REQUEST_URI']);
$_SERVER['SERVER_NAME'] = host; // nginx..

define("assets", build? assetsbuild : assetssource);
define('imgs', assets . 'imgs/');
define('fonts', assets . 'fonts/');
define("views", "{$kirby->roots->templates}/");
define("layouts", views . "/" . "layouts/");
define("assets_", root . str_replace('/', DS, assets));

// Load tree and get target dir.
$tree = @file_get_contents(root . assetsbuild . 'tree.json');
$tree = $tree? json_decode($tree, true) : [];
$treesub = array_filter(explode('/', assets));
foreach($treesub as $t) $tree = $tree[$t];
c::set('tree', $tree);

// Kirby configurations.
c::set('url', http . host);
c::set('license', 'K2-PERSONAL-c6b3515c6fdce1eb791bde3c772befbd');
c::set('debug', debug);
c::set('cache', cache);
c::set('thumbs.driver', prod? 'im' : 'gd');
c::set('kirbytext.filters', array());
c::set('panel.stylesheet', 'assets/css/admin.css');
c::set('simplemde.kirbytagHighlighting', false);
c::set('simplemde.buttons', array(
  "bold",
  "italic",
  "link",
  "email"
));

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
    'pattern' => ["(/)", "(.+)"],
    'action' => function($path) {
      define('jview', false);
      $page = page($path == '/'? 'home' : $path);
      if (!$page) $page = site()->errorPage();
      return $page;
    }
  ]
]);
