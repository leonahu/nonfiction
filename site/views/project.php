<?php
  $o = (object)[];
  $o->page = $page->slug();// $page->intendedTemplate();
  $o->class = "project";
  $o->title = b::title($page);
  $o->tree = c::get("tree");
  $o->tags = str::split($page->tags(),',');
  $o->cover = $page->coverimage()->toFile();
  $o->next = $page->nextVisible();
  $o->prev = $page->prevVisible();

  function caption($image) {
    if (!$image->caption()->value()) 
      return "<img src='". b::asset($image->url()) ."'>";
    else return 
      "<div class='captioned'><img src='". b::asset($image->url()) ."'>".
      "<div class='caption init'>".
      "<i><div class='close'><b></b><b></b></div></i>".
      "<span><span>". $image->caption() ."</span></span>".
      "</div></div>";
  }

  ob_start();
?>


<div class="sidebar">
  <div class="box">
    <div>
      <?php echo '<a href="'. ($o->next? $o->next->url() : "#") .'" class="next '. ($o->next? '' : "off") .'">Next</a>'; ?>
      <?php echo '<a href="'. ($o->prev? $o->prev->url() : "#") .'" class="prev '. ($o->prev? '' : "off") .'">Previous</a>'; ?>
    </div>
  </div>
</div>


<main>
  <div class="box">
    <div class="heading ac">
      <div class="left">
        <h1><?php echo $page->title() ?></h1>
        <h2><?php echo $page->subheading() ?></h2>
        <div class="client">Client: <?php echo $page->client() ?></div>
      </div>
      <ul class="right">
        <?php foreach($o->tags as $tag) echo "<li>$tag</li>"; ?>
      </ul>
    </div>
  </div>

  <div class="box boxfeature">
    <div class="feature">
      <div class="caption init">
        <i><div class="close"><b></b><b></b></div></i>
        <span><span><?php echo $o->cover->caption() ?></span></span>
      </div>
      <img src="<?php echo b::asset($o->cover->url()) ?>" alt="<?php echo $o->cover->alt() ?>">
    </div>
  </div>
</main>


<?php 
  foreach($page->builder()->toStructure() as $s) { 
    $type = $s->_fieldset();
    $text1 = $s->text1();
    $image1 = $page->image($s->image1());
    $text2 = $s->text2();
    $image2 = $page->image($s->image2());
    echo "<section class='$type'><div class='box content ac'>";

    if ($type == 'column1') {
      if ($text1->value) echo $text1->kt();
      else echo caption($image1);

    } else {
      echo "<div>";
      if ($text1->value) echo $text1->kt();
      else echo caption($image1);

      echo "</div><div>";
      if ($text2->value) echo $text2->kt();
      else echo caption($image2);
      echo "</div>";
    }
    
    echo "</div></section>";
  }
?>


<?php $o->view = ob_get_clean() ?>
<?php include layouts . "layout1.php" ?>