<?php
  $o = (object)[];
  $o->page = $page->slug();// $page->intendedTemplate();
  $o->class = "faq";
  $o->title = b::title($page, $site);
  $o->tree = c::get("tree");
  ob_start();
?>


<main>
  <div class="box ac">
    <div>
      <h2><?php echo $page->heading1() ?></h2>
      <?php foreach ($page->questions1()->toStructure() as $i=>$q) { ?>
      <div class="qa <?php if (!$i) echo 'on' ?>">
        <h3><?php echo $q->question() ?></h3>
        <span class="text"><span><?php echo $q->answer()->qt() ?></span></span>
        <div class="close"><b></b><b></b></div>
      </div>
      <?php } ?>
    </div>

    <div>
      <h2><?php echo $page->heading2() ?></h2>
      <?php foreach ($page->questions2()->toStructure() as $i=>$q) { ?>
      <div class="qa <?php if (!$i) echo 'on' ?>">
        <h3><?php echo $q->question() ?></h3>
        <span class="text"><span><?php echo $q->answer()->qt() ?></span></span>
        <div class="close"><b></b><b></b></div>
      </div>
      <?php } ?>
    </div>

    <div>
      <h2><?php echo $page->heading3() ?></h2>
      <?php foreach ($page->questions3()->toStructure() as $i=>$q) { ?>
      <div class="qa <?php if (!$i) echo 'on' ?>">
        <h3><?php echo $q->question() ?></h3>
        <span class="text"><span><?php echo $q->answer()->qt() ?></span></span>
        <div class="close"><b></b><b></b></div>
      </div>
      <?php } ?>
    </div>
  </div>
</main>


<?php $o->view = ob_get_clean() ?>
<?php include layouts . "layout1.php" ?>