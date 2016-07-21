

$(".publish").click(function() {
bathroom = ($(this).val());
$.ajax( {
            url : "publish.php?do=update&id="+bathroom,
            type : "GET",
            success : function(data) {
            	$(".publishThis"+bathroom).html("Unpublish");
                //alert ("published"+bathroom); //or use data string to show something else
                }
            });
});



$(".unpublish").click(function() {
bathroom = ($(this).val());
$.ajax( {
            url : "unpublish.php?do=update&id="+bathroom,
            type : "GET",
            success : function(data) {
            	$(".publishThis"+bathroom).html("Publish");
               // alert ("unpublished"+bathroom); //or use data string to show something else
                }
            });
});

$(".delete").click(function() {
bathroom = ($(this).val());
if (confirm("Are you sure you want to delete")) {
    $.ajax( {
    		url : "delete.php?id="+bathroom,
            type : "POST",
            success : function(data) {
            	$('#bathroom'+bathroom).hide();
               // alert ("unpublished"+bathroom); //or use data string to show something else
                }
            });
  }
});
