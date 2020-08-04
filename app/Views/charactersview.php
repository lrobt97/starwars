<?php $id = 1; ?>
<?php foreach ($characters as $character) : ?>
<?php
   echo"<p class='character' id='character".$id."'> ".$character->name." </p>";
   $id++;
?>
<?php endforeach ?>
