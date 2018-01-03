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
    <div>
      <div class="title">
        <h2>Vuli: Tremor Management Wearable</h2>
        <h3>Cala Health</h3>
      </div>
      <a href="http://non.rickyboyce.me/projects/vuli"><img src="<?php echo b::asset($o->tree['imgs']['featured']['1']) ?>"></a>
    </div>
    <div>
      <div class="title">
        <h2>Wireless Headphone</h2>
        <h3>Human Inc</h3>
      </div>
      <a href="#"><img src="<?php echo b::asset($o->tree['imgs']['featured']['2']) ?>"></a>
    </div>
    <div>
      <div class="title">
        <h2>Shuttle Collection</h2>
        <h3>Eternal Luxe x Divka</h3>
      </div>
      <a href="#"><img src="<?php echo b::asset($o->tree['imgs']['featured']['3']) ?>"></a>
    </div>
    <div>
      <div class="title">
        <h2>Wireless charging ecosystem</h2>
        <h3>Intel</h3>
      </div>
      <a href="#"><img src="<?php echo b::asset($o->tree['imgs']['featured']['4']) ?>"></a>
    </div>
    <div>
      <div class="title">
        <h2>Vuli: Tremor Management Wearable</h2>
        <h3>Cala Health</h3>
      </div>
      <a href="#"><img src="<?php echo b::asset($o->tree['imgs']['featured']['1']) ?>"></a>
    </div>
    <div>
      <div class="title">
        <h2>Wireless Headphone</h2>
        <h3>Human Inc</h3>
      </div>
      <a href="#"><img src="<?php echo b::asset($o->tree['imgs']['featured']['2']) ?>"></a>
    </div>
  </div>
</main>


<?php $o->view = ob_get_clean() ?>
<?php include layouts . "layout1.php" ?>