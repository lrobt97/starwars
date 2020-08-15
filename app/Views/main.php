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
  // Original JavaScript code by Chirp Internet: www.chirp.com.au (cookies)
  function getCookie(name)
  {
    var re = new RegExp(name + "=([^;]+)");
    var value = re.exec(document.cookie);
    return (value != null) ? unescape(value[1]) : null;
  }
  function setCookie(name, value)
  {
    var today = new Date();
    var expiry = new Date(today.getTime() + 30 * 86400 * 1000); // plus 30 days
    document.cookie = name + "=" + value + "; expires=" + expiry.toGMTString() + "; path=/";
  }
  function deleteCookie(name)
  {
    var today = new Date();
    // set the expiry in the past so the cookie gets deleted
    document.cookie = name + "=[]; expires="+ new Date(today.getTime() -1) + "; path=/";
  }

	jQuery.noConflict();
	jQuery(document).ready(function()
    {
        var pageNumber = <?= $page ?>;
        var maxPages = <?= $pagecount ?>;
        var itemsSelected = [];
        // check if the cookie has already been set and load the page
        if (getCookie("items"))
        {
          itemsSelected = JSON.parse(getCookie("items"));
          for (var i = 0; i<=2; i++)
          {
            if (!jQuery.isEmptyObject(itemsSelected[i]))
            {
              jQuery("#selectedCharacter" + (i + 1)).text("Option " + (i + 1) +": "+ itemsSelected[i].name);
            }
          }
        }
        var isItemSelected = false;
        function addOptionToList(elementClicked)
        {
            var threeItemsSelected = true;
            for (var i = 0; i<=2 ; i++)
            {
                if (!itemsSelected[i] || jQuery.isEmptyObject(itemsSelected[i]))
                {
                  elementClicked.removeClass("panel-primary");
                  elementClicked.addClass("panel-success");
                  elementClicked.find(".panel-footer").text("Selected");
                  itemsSelected[i]={
                    name: elementClicked.find("#characterName").text(),
                    url: elementClicked.find("#characterUrl").attr("href"),
                  };
                  setCookie("items", JSON.stringify(itemsSelected));
                  jQuery("#selectedCharacter" + (i + 1)).text("Option " + (i + 1) +": "+ itemsSelected[i].name);
                  threeItemsSelected = false;
                  break;
                }
            }       
            if (threeItemsSelected)
            {
                alert("You can only select 3 items.");
            } 
        }
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
        jQuery("#reset").click(function()
	    {
            itemSelectedCount=0;
            itemsSelected = [];
            deleteCookie("items")
            for(var i = 1; i<=3; i++)
            {
                jQuery("#selectedCharacter"+ i).text("Option "+i+": None");
            }
            jQuery("#characterBox").load("/home/view/" + pageNumber);
        });
        jQuery("#download").click(function()
	    {
            var threeOptionsSelected = true;
            for (var i =0; i<=2; i++)
            {
               if (!itemsSelected[i] || jQuery.isEmptyObject(itemsSelected[i]))
               {
                 threeOptionsSelected = false;
                 break;
               }
            }
            if (threeOptionsSelected)
            {
                window.location="/home/download/";
            }
            else
            {
                alert("Three items must be selected before downloading.");
            }
        });
	      jQuery("#next").click(function()
	    {
            if (pageNumber + 1 <= maxPages)
            {
            pageNumber ++;
		        jQuery("#characterBox").load("/home/view/" + pageNumber);
            jQuery("#pageCount").text("Page " + pageNumber);
            }
            else 
            {
              alert("No more information available");
            }
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
                          itemsSelected[i] ={
                          };
                          jQuery(this).removeClass("panel-success");
                          jQuery(this).addClass("panel-primary");
                          jQuery(this).find(".panel-footer").text("Unselected");
                          jQuery("#selectedCharacter" + (i + 1)).text("Option " + (i + 1) +": None");
                          setCookie("items", JSON.stringify(itemsSelected));
                          isItemSelected=true;
                          break;
                        }
                }
                if (!isItemSelected)
                {
                    addOptionToList(jQuery(this));
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
<div class="container">
  <div class="page-header">
    <h1>Star Wars App</h1>      
  </div>
  <p>Please select 3 characters. So far you have selected:</p>      
  <p id="selectedCharacter1">Option 1: None</p>      
  <p id="selectedCharacter2">Option 2: None</p>      
  <p id="selectedCharacter3">Option 3: None</p>      
<div class = "btn-group">
<button class="btn-success" id="download">Download CSV</button>
<button class="btn-danger" id="reset">Reset options</button>
</div>
</div>
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