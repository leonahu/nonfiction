<?php
  $o = (object)[];
  $o->page = $page->slug();// $page->intendedTemplate();
  $o->class = "about";
  $o->title = b::title($page);
  $o->tree = c::get("tree");
  ob_start();
?>


<main>
  <div class="content box">
    <div class="heading ac">
      <div class="middle">
        <?php echo $page->intro()->kt() ?>
      </div>
      <div class="left">
        <img src="<?php echo b::asset($page->image1()->toFile()->url()) ?>" 
          alt="<?php echo $page->image1()->toFile()->alt() ?>">
      </div>
      <div class="right">
        <img src="<?php echo b::asset($page->image2()->toFile()->url()) ?>" 
          alt="<?php echo $page->image2()->toFile()->alt() ?>">
      </div>
    </div>
  </div>
</main>


<section class="who">
  <div class="box content ac">
    <h2>Who we are</h2>
    <div class="left"><?php echo $page->owner1()->kt() ?></div>
    <div class="right"><?php echo $page->owner2()->kt() ?></div>
  </div>
</section>


<section class="workwith">
  <div class="box content">
    <?php echo $page->bottom()->kt() ?>
  </div>
</section>


<?php $o->view = ob_get_clean() ?>
<?php include layouts . "layout1.php" ?>