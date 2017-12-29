<?php
  $o = (object)[];
  $o->page = $page->slug();// $page->intendedTemplate();
  $o->class = $page->slug();
  $o->title = b::title($page);
  $o->tree = c::get("tree");
  //$o->home = $site->homePage();
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
          <div id="smoke" class="smoke">
            <img data-depth="0.8" class="bg" src="<?php echo b::asset($o->tree['imgs']['1']) ?>">
            <img data-depth="0.5" class="fg" src="<?php echo b::asset($o->tree['imgs']['2']) ?>">
          </div>
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
      <div class="mouse"><span></span></div>
    </div>
  </div>


  <div id="featured" class="featured section">
    <div>
      <div class="box">
        <h2 class="left">We bring concepts to shelves, fiction into reality.</h2>

        <div class="right">
          <div class="title ac">
            <h3>Vuli: Tremor Management Wearable</h3>
            <h4>Carla Health</h4>
          </div>
          <div class="images">
            <div><img data-title="Vuli: Tremor Management Wearable" data-for"Carla Health" 
              src="<?php echo b::asset($o->tree['imgs']['featured']['1'])?>"></div>
            <div><img data-title="Vuli: Tremor Management Wearable" data-for"Carla Health" 
              src="<?php echo b::asset($o->tree['imgs']['featured']['3'])?>"></div>
            <div><img data-title="Vuli: Tremor Management Wearable" data-for"Carla Health" 
              src="<?php echo b::asset($o->tree['imgs']['featured']['2'])?>"></div>
            <div><img data-title="Vuli: Tremor Management Wearable" data-for"Carla Health" 
              src="<?php echo b::asset($o->tree['imgs']['featured']['4'])?>"></div>
            <div><img data-title="Vuli: Tremor Management Wearable" data-for"Carla Health" 
              src="<?php echo b::asset($o->tree['imgs']['featured']['3'])?>"></div>
            <div><img data-title="Vuli: Tremor Management Wearable" data-for"Carla Health" 
              src="<?php echo b::asset($o->tree['imgs']['featured']['2'])?>"></div>
          </div>
        </div>

        <div class="left">
          <div class="list">
            <ul>
              <li class="active"><a href="#"><i>01</i>Wearable Technology</a><b></b></li>
              <li><a href="#"><i>02</i>Medical / Health Care</a><b></b></li>
              <li><a href="#"><i>03</i>Fashion Soft Goods</a><b></b></li>
              <li><a href="#"><i>04</i>Consumer IoT</a><b></b></li>
              <li><a href="#"><i>05</i>Branding</a><b></b></li>
              <li><a href="#"><i>06</i>Design Strategy</a><b></b></li>
            </ul>
          </div>
          <a class="more linkspan" href="/projects">
            <span>Check out our portfolio</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 12">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M1.057 7.125l23.229-.063-3.563 3.5 1.469 1.375s5.719-5.438 5.719-5.906S22.13.063 22.13.063L20.786 1.5l3.406 3.469L1.088 5s-1-.031-1 1.031.969 1.094.969 1.094z"/>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>


<?php $o->view = ob_get_clean() ?>
<?php include layouts . "layout1.php" ?>