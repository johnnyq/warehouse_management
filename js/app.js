
//Submits All Form POST data with div id #ajaxform via AJAX
$("#ajaxAddForm").submit(function(e){
	var postData = $(this).serializeArray();	   
    $.ajax(
    {
        url: "post.php",
        type: "POST",
        data: postData,
        success : function(response)
        {
            $('#ajaxAddForm').trigger("reset");
    		    $("form:not(.filter) :input:visible:enabled:first").focus();
            $("#response").html(response);
        }, 	
    });
    e.preventDefault(); //STOP default POST action
});

$("#ajaxEditForm").submit(function(e){
	var postData = $(this).serializeArray();	   
    $.ajax(
    {
        url : "post.php",
        type: "POST",
        data : postData,
        success : function(response)
        {
            $("#response").html(response);
        }, 	
    });
    e.preventDefault();
});

$(".delete_user").click(function(){
   var del_id = $(this).attr('id');
   var ele = $(this).parent().parent().parent();
   $.ajax({
      type:'POST',
      url:'post.php',
      data:'delete_user='+del_id,
      success:function(response) {
        ele.fadeOut().remove();
        $("#response").html(response);
      }
   });
 });

$(".checkout_item").click(function(){
   var id = $(this).attr('id');
   var ele = $(this).parent().parent().parent();
   $.ajax({
      type:'POST',
      url:'post.php',
      data:'checkout_item='+id,
      success:function(response) {
        ele.fadeOut().remove();
        $("#response").html(response);
      }
   });
 });

$(function() {
    // Highlight the active nav link.
    var url = window.location.pathname;
    var filename = url.substr(url.lastIndexOf('/') + 1);
    $('.navbar a[href$="' + filename + '"]').parent().addClass("active");
});