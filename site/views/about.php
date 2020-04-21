<?php
  $o = (object)[];
  $o->page = $page->slug();// $page->intendedTemplate();
  $o->class = "about";
  $o->title = b::title($page, $site);
  $o->tree = c::get("tree");
  $members = $page->team()->toStructure();
  ob_start();
?>


<main>
  <div class="content box">
    <div class="heading ac">
      <div class="middle">
        <?php echo $page->intro()->kt() ?>
        <p><?php echo b::x() ?></p>
        <h2>Who we are</h2>
      </div>
      <div class="left">
        <?php echo b::x(['#fff']) ?>
        <img data-object-fit src="<?php echo b::asset($page->image1()->toFile()->url()) ?>" 
          alt="<?php echo $page->image1()->toFile()->alt() ?>">
      </div>
      <div class="right">
        <?php echo b::x(['#fff']) ?>
        <img data-object-fit src="<?php echo b::asset($page->image2()->toFile()->url()) ?>" 
          alt="<?php echo $page->image2()->toFile()->alt() ?>">
      </div>
    </div>
  </div>
</main>


<section class="who">
  <div class="box content ac">
    <div class="left"><?php echo $page->owner1()->kt() ?></div>
    <div class="right"><?php echo $page->owner2()->kt() ?></div>
  </div>
</section>


<?php if (count($members) > 0) { ?>
<section class="team">
  <div class="box content ac">
    <div class="members">
      <?php
      foreach ($members as $member) {
        $img = b::asset($member->image()->toFile()->crop(500, 500)->url())
      ?>
        <div class="member">
          <img src="<?php echo $img ?>" />
          <h4><?php echo $member->name ?></h4>
          <div class="position"><?php echo $member->position ?></div>
          <div class="description"><?php echo $member->description->kt() ?></div>
        </div>
      <?php } ?>
    </div>
  </div>
</section>
<?php } ?>


<section class="workwith">
  <div class="box content">
    <?php echo $page->bottom()->kt() ?>
  </div>
</section>


<?php $o->view = ob_get_clean() ?>
<?php include layouts . "layout1.php" ?>
