<?php 
if (defined('jview') && jview) {
  echo json_encode([
    "view" => $o->view,
    "page" => $o->page,
    "class" => $o->class,
    "title" => $o->title
  ]);

} else {
  require views . 'partials/header.php';
  echo "<div class='view'>$o->view</div>";
  require views . 'partials/footer.php';
}
