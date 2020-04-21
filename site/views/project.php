<?php
  $o = (object)[];
  $o->page = $page->slug();// $page->intendedTemplate();
  $o->class = "project";
  $o->title = b::title($page, $site);
  $o->tree = c::get("tree");
  $o->tags = str::split($page->tags(),',');
  $o->cover = $page->coverimage()->toFile();
  $o->next = $page->nextVisible();
  $o->prev = $page->prevVisible();
  if (array_key_exists('password', $_POST)) $hasAccess = requestAccess($page);
  else $hasAccess = $page->password() == ""? true : hasAccess($page);

  // Use first and last if none.
  if (!$o->prev) $o->prev = $page->parent()->children()->visible()->last();
  if (!$o->next) $o->next = $page->parent()->children()->visible()->first();

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

  function requestAccess($page) {
    if ($_POST['password'] == "") return;
    $id = "p-" . preg_replace("/\//", "-", $page->id());
    $opts = [ 'salt' => 'qwef3HDsnf823fff3445dhfy' ]; // fix salt
    $hash = password_hash($page->password() . $id, PASSWORD_BCRYPT, $opts);
    // Verify password is correct
    if (password_verify($_POST['password'] . $id, $hash)) {
      setcookie($id, $hash, time() + 60*60*24*364, '/');
      return true;
    }
  }

  function hasAccess($page) {
    $id = "p-" . preg_replace("/\//", "-", $page->id());
    $opts = [ 'salt' => 'qwef3HDsnf823fff3445dhfy' ]; // fix salt
    // Check if password cookie is set
    if (!isset($_COOKIE[$id])) return;
    // Get the true password hash
    $hash = password_hash($page->password() . $id, PASSWORD_BCRYPT, $opts);
    // Check if cookie checks out
    if ($hash == $_COOKIE[$id]) {
      setcookie($id, $hash, time() + 60*60*24*364, '/'); // prolong
      return true;
    }
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


<?php if (!$hasAccess) { ?>
<main>
  <div class="box">
    <div class="heading ac">
      <div class="left">
        <h1><?php echo $page->title() ?></h1>
        <h2>Password protected</h2>
      </div>
    </div>
  </div>
  <div class="box boxpassword content ac">
    <div>
      <p>This project is password protected, please enter the provided password below.</p>
      <form method="post">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="" />
        <button type="submit" value="Submit">Submit</button>
      </form>
    </div>
  </form>
</main>


<?php } else { ?>
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
      else echo "<figure>". caption($image1)."</figure>"; 

    } else {
      if ($text1->value) echo "<div>". $text1->kt()."</div>";
      else echo "<figure>". caption($image1)."</figure>"; 

      echo "<span>&nbsp;</span>";

      if ($text2->value) echo "<div>". $text2->kt()."</div>";
      else echo "<figure>". caption($image2)."</figure>"; 
    }
    
    echo "</div></section>";
  }
?>
<?php } ?>


<?php $o->view = ob_get_clean() ?>
<?php include layouts . "layout1.php" ?>
