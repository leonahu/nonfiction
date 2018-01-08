
<?php 
  echo b::js($o->tree, ['js', 'libs']);
  echo b::js($o->tree, ['js']);
  if ($site->google()->value) echo "<script>". $site->google() ."</script>";
?>
</body>
</html>