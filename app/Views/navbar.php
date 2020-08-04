<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
</script>
<script>
	jQuery.noConflict();
	jQuery(document).ready(function()
    {
        var pageNumber = <?= $page ?>;
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
	});
</script>
<div id="characterBox">
</div>
<div class ="navbar">
<button id="prev">Previous page</button>
<p id="pageCount">Page 1</p>
<button id="next">Next page</button>
</div>
