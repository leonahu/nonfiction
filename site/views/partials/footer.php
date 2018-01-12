
<?php 
  echo b::js($o->tree, ['js', 'libs']);
  echo b::js($o->tree, ['js']);
  if ($site->google()->value) echo $site->google();
?>
</body>
</html>