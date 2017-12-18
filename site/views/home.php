<?php
  $o = (object)[];
  $o->page = $page->slug();// $page->intendedTemplate();
  $o->class = $page->slug();
  $o->title = b::title($page);
  $o->tree = c::get("tree");
  $o->home = $site->homePage();
  ob_start();
?>


<div class="intro">
  <div class="box">
    <div class="non">
      <img src="<?php echo b::asset($o->tree['imgs']['1']) ?>">
      <svg xmlns="http://www.w3.org/2000/svg" width="460" height="460" viewBox="0 0 942 942">
        <defs>
          <mask id="holex">
            <rect width="100%" height="100%" fill="white"/>
            <path fill-rule="evenodd" clip-rule="evenodd" fill="#000" d="M86 670l199-200L86 272 272 86l199 198L668 88l188 184-198 197 198 200-185 187-200-200-199 198L86 670z"/>
          </mask>
        </defs>
        <path fill-rule="evenodd" clip-rule="evenodd" fill="#fff" mask="url(#holex)" d="M0 0h942v942H0V0z"/>
      </svg>
    </div>
    <h1>Nonfiction is a boutique full-service design agency, creating real products that surprise and delight.</h1>
  </div>
</div>


<?php $o->view = ob_get_clean() ?>
<?php include layouts . "layout1.php" ?>