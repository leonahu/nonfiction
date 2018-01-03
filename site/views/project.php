<?php
  $o = (object)[];
  $o->page = $page->slug();// $page->intendedTemplate();
  $o->class = "project";
  $o->title = b::title($page);
  $o->tree = c::get("tree");
  $o->tags = str::split($page->tags(),',');
  $o->cover = $page->coverimage()->toFile();
  ob_start();
?>


<main>
  <div class="box">
    <div class="heading">
      <div class="left">
        <h1><?php echo $page->title() ?></h1>
        <h2><?php echo $page->subheading() ?></h2>
        <div class="client"><?php echo $page->client() ?></div>
      </div>
      <ul class="right">
        <?php foreach($o->tags as $tag) echo "<li>$tag</li>"; ?>
      </ul>
    </div>

    <div class="feature">
      <div class="caption">
        <i></i>
        <span><?php echo $o->cover->caption() ?></span>
      </div>
      <img src="<?php echo b::asset($o->cover->url()) ?>" alt="<?php echo $o->cover->alt() ?>">
    </div>
  </div>
</main>


<?php $o->view = ob_get_clean() ?>
<?php include layouts . "layout1.php" ?>