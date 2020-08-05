<?php 
   $id = 1; 
   $items;
   if(!is_null($_COOKIE['items']))
   {
	   $items = json_decode($_COOKIE['items']);
   }
   echo "<div class='container'>";
?>
<?php foreach ($characters as $character) : ?>
<?php
   if ($id % 3 ==1)
   {
		echo "<div class='row'>";
   }
   echo "<div class ='col-sm-4'>";

   // if the character is saved in the cookie, load a different HTML format
   $isSelected=false;
   foreach($items as $item)
   {
	   if($item->name == $character->name)
	   {
   		echo "<div class='characterBox panel panel-success'>";
   		echo "<div class='panel-heading' id = 'characterName'>".$character->name."</div>";
   		echo "<div class='panel-body'><a id = 'characterUrl' href='".$character->url."'>SWAPI Information</a></div>";
   		echo "<div class='panel-footer'>Selected</div>";
   		echo "</div>";
		echo "</div>";
		$isSelected = true;
	   }
   }

   if(!$isSelected)
   {
	echo "<div class='characterBox panel panel-primary'>";
	echo "<div class='panel-heading' id = 'characterName'>".$character->name."</div>";
	echo "<div class='panel-body'><a id = 'characterUrl' href='".$character->url."'>SWAPI Information</a></div>";
	echo "<div class='panel-footer'>Unselected</div>";
	echo "</div>";
 	echo "</div>";
   }

   if ($id % 3 ==1)
   {
		echo "</div>";
   }
   $id++;
?>
<?php endforeach ?>
<?php 
	echo "</div>";
?>
