<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Starwars Main</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
	jQuery.noConflict();
	jQuery(document).ready(function()
    {
        var pageNumber = <?= $page ?>;
        var itemsSelected = [];
        var isItemSelected = false;
        function addOptionToList(elementClicked)
        {
            if (itemsSelected.length < 3)
             {
                elementClicked.removeClass("panel-primary");
                elementClicked.addClass("panel-success");
                elementClicked.find(".panel-footer").text("Selected");
              itemsSelected.push
              (
                {
                    name: elementClicked.find("#characterName").text(),
                    url: elementClicked.find("#characterUrl").attr("href"),
                }
               );
               document.cookie="items="+JSON.stringify(itemsSelected);
             }
               else
                {
                  alert("You can only select 3 items.");
                }
        }
        document.cookie="items="+JSON.stringify(itemsSelected);
		jQuery("#characterBox").load("/home/view/" + pageNumber);
	    jQuery("#prev").click(function()
	    {
          if (pageNumber > 1)
          {
            pageNumber--;
		    jQuery("#characterBox").load("/home/view/" + pageNumber);
            jQuery("#pageCount").text("Page " + pageNumber);
          }
          else
          {
            alert("You are already on the first page.");
          }
	    });
	    jQuery("#next").click(function()
	    {
            pageNumber ++;
		    jQuery("#characterBox").load("/home/view/" + pageNumber);
            jQuery("#pageCount").text("Page " + pageNumber);
	    });
        jQuery("body").on("click", "div.characterBox", function()
        {
            if (itemsSelected.length >= 1)
            {
                for(var i = 0; i<itemsSelected.length; i++)
                {
                    if(itemsSelected[i].name == jQuery(this).find("#characterName").text()
                    && itemsSelected[i].url == jQuery(this).find("#characterUrl").attr("href"))
                        {
                          isItemSelected=true;
                        }
                }
                if (!isItemSelected)
                {
                    addOptionToList(jQuery(this));
                }
                else
                {
                    alert("You have already selected this option.");
                }
            }
            else // no options selected no need for checks
            {
                addOptionToList(jQuery(this));
            }
            // reset the flag so it doesn't interefere with future interactions
            isItemSelected = false;
        });
	});
</script>
</head>
<body>
<div id="characterBox" class="container">
</div>
<nav class ="navbar navbar-default">
<ul class="pager">
<li class ='previous'><button id="prev" class="btn btn-primary">Previous page</button></li>
<li class='active'><p id="pageCount">Page 1</p></li>
<li class ='next'><button id="next" class="btn btn-primary">Next page</button></li>
</ul>
</nav>
</body>
</html>