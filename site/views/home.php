<?php
  $o = (object)[];
  $o->page = $page->slug();// $page->intendedTemplate();
  $o->class = $page->slug();
  $o->title = b::title($page, $site);
  $o->tree = c::get("tree");
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
      <h1><?php echo $page->intro()->kt() ?></h1>
      <div class="mouse"><div><span></span></div></div>
    </div>
  </div>


  <div id="featured" class="featured section">
    <div>
      <div class="box">
        <h2 class="left"><?php echo $page->title2()->kt() ?></h2>

        <?php 
          // Get projects data.
          $projs = [];
          foreach ($page->projects()->toStructure() as $item) {
            $proj = $site->find('projects')->find($item->project());
            array_push($projs, (object) [
              "heading"=> $item->title(),
              "url" => $proj->url(),
              "title" => $proj->title(),
              "client" => $proj->client(),
              "cover" => b::asset($proj->coverimage()->toFile()->resize(811, 578)->url())
            ]);
            } 
          ?>  
          <div class="right">
            <div class="title ac">
              <h3><?php echo $projs[0]->title ?></h3>
              <h4><?php echo $projs[0]->client ?></h4>
            </div>
            <div class="images">
              <a class="hittest" href="<?php echo $projs[0]->url ?>"></a>
              <div>
                <?php foreach ($projs as $p) { ?>
                  <a href="<?php echo $p->url ?>" class="image">
                    <img data-title="<?php echo $p->title ?>" data-for="<?php echo $p->client ?>" src="<?php echo $p->cover ?>">
                  </a>
                <?php } ?>
              </div>
            </div>
          </div>

          <div class="left">
            <div class="list">
              <ul>
                <?php foreach ($projs as $i => $p) { ?>
                <?php $active = !$i? 'class="active"' : ''; ?>
                <?php echo "<li $active><a href='$p->url'><i>0". ($i+1) ."</i>$p->heading</a><b></b></li>" ?>
              <?php } ?>
            </ul>
          </div>
          <a class="more linkspan" href="/projects">
            <span><?php echo $page->link() ?></span>
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