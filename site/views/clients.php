<?php
  $o = (object)[];
  $o->page = $page->slug();// $page->intendedTemplate();
  $o->class = "clients";
  $o->title = b::title($page, $site);
  $o->tree = c::get("tree");
  $o->heading = $page->heading1()->value;
  ob_start();
?>


<main>
  <div class="box">
    <div class="content">
      <div class="box2">
        <?php if ($o->heading) { ?><h1><?php echo $o->heading ?></h1><?php } ?>
        <?php echo $page->text()->kt() ?>
        <h2><?php echo $page->heading2() ?></h2>
        <div class="columns"><!--
          <?php foreach ($page->clients()->toStructure() as $i=>$c) { ?>
            --><div class="column">
              <h3><?php echo $c->category() ?></h3>
              <?php echo multiline($c->text()->qt()) ?>
            </div><!--
          <?php } ?>
      --></div>
      </div>

      <div class="bg">
        <div class="grad1"></div>
        <div class="grad2"></div>
        <div class="video">
          <video autoplay loop>
            <source src="<?php echo b::asset($o->tree['imgs']['client_bg']) ?>">
          </video>
        </div>
      </div>
    </div>
  </div>
</main>


<?php $o->view = ob_get_clean() ?>
<?php include layouts . "layout1.php" ?>