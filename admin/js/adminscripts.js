

$(".publish").click(function() {
company = ($(this).val());
$.ajax( {
            url : "publish.php?do=update&id="+company,
            type : "GET",
            success : function(data) {
            	$(".publishThis"+company).html("Unpublish");
                //alert ("published"+company); //or use data string to show something else
                }
            });
});



$(".unpublish").click(function() {
company = ($(this).val());
$.ajax( {
            url : "unpublish.php?do=update&id="+company,
            type : "GET",
            success : function(data) {
            	$(".publishThis"+company).html("Publish");
               // alert ("unpublished"+company); //or use data string to show something else
                }
            });
});

$(".delete").click(function() {
company = ($(this).val());
if (confirm("Are you sure you want to delete")) {
    $.ajax( {
    		url : "delete.php?id="+company,
            type : "POST",
            success : function(data) {
            	$('#company'+company).hide();
               // alert ("unpublished"+company); //or use data string to show something else
                }
            });
  }
});
