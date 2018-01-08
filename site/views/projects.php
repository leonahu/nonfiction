<?php
  $o = (object)[];
  $o->page = $page->slug();// $page->intendedTemplate();
  $o->class = $page->slug();
  $o->title = b::title($page);
  $o->tree = c::get("tree");
  ob_start();
?>


<main class="list">
  <div class="box">
    <?php foreach ($page->children()->visible() as $s) {
      $cover = $s->coverimage()->toFile();
      $thumb = ($cover)? $cover->crop(662, 472) : null;
      $thumburl = ($cover)? $thumb->url() : '';
    ?>
      <div>
        <div class="title">
          <h2><?php echo $s->title() ?></h2>
          <h3><?php echo $s->client() ?></h3>
        </div>
        <a href="/<?php echo $s->uri() ?>"><img src="<?php echo b::asset($thumburl) ?>"></a>
      </div>
    <?php } ?>
  </div>
</main>


<?php $o->view = ob_get_clean() ?>
<?php include layouts . "layout1.php" ?>