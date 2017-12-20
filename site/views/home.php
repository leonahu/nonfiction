<?php
  $o = (object)[];
  $o->page = $page->slug();// $page->intendedTemplate();
  $o->class = $page->slug();
  $o->title = b::title($page);
  $o->tree = c::get("tree");
  $o->home = $site->homePage();
  ob_start();
?>


<div id="fullpage">
  <div class="intro section">
    <div class="box">
      <div class="n1">
        <div>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 65 71">
            <path fill-rule="evenodd" clip-rule="evenodd" fill="#3b3b3b" d="M0 71V0h16l32 42V0h17v71H49L17 29v42H0z"/>
          </svg>
        </div>
      </div><!--
    --><div class="non">
        <div>
          <img src="<?php echo b::asset($o->tree['imgs']['1']) ?>">
          <svg xmlns="http://www.w3.org/2000/svg" width="470" height="470" viewBox="0 0 942 942">
            <defs>
              <mask id="holex">
                <rect width="100%" height="100%" fill="white"/>
                <path fill-rule="evenodd" clip-rule="evenodd" fill="#000" d="M86 670l199-200L86 272 272 86l199 198L668 88l188 184-198 197 198 200-185 187-200-200-199 198L86 670z"/>
              </mask>
            </defs>
            <path fill-rule="evenodd" clip-rule="evenodd" fill="#fff" mask="url(#holex)" d="M0 0h942v942H0V0z"/>
          </svg>
        </div>
      </div><!--
    --><div class="n2">
        <div>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 65 71">
            <path fill-rule="evenodd" clip-rule="evenodd" fill="#3b3b3b" d="M0 71V0h16l32 42V0h17v71H49L17 29v42H0z"/>
          </svg>
        </div>
      </div>
      <h1>Nonfiction is a boutique full-service design agency, creating real products that surprise and delight.</h1>
    </div>
  </div>


  <div id="featured" class="featured section">
    <div class="box">
      <div class="left">
        <h2>We bring concepts to shelves, fiction into reality.</h2>
        <ul>
          <li><a href="#"><i>01</i>Wearable Technology</a></li>
          <li><a href="#"><i>02</i>Medical / Health Care</a></li>
          <li><a href="#"><i>03</i>Fashopm Soft Goods</a></li>
          <li><a href="#"><i>04</i>Consumer IoT</a></li>
          <li><a href="#"><i>05</i>Branding</a></li>
          <li><a href="#"><i>06</i>Design Strategy</a></li>
        </ul>
        <a class="more" href="#">Check out out portfolio<span></span></a>
      </div>

      <div class="right">
        <h3></h3>
        <h4></h4>
        <div class="images">
          <div><img src="<?php echo b::asset($o->tree['imgs']['featured']['1'])?>"></div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php $o->view = ob_get_clean() ?>
<?php include layouts . "layout1.php" ?>