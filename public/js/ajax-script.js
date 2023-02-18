function deleteItem(url, showUrl, showTo)
 {
    $.ajax({
        url: url,
        cache: false,
        type: "GET",
        success: function(data){
           loadPage2(showUrl, showTo);
        }
    });

    return false;
} 

function loadPage(url, showTo)
 {
  	$('#'+showTo).html('').append("<div style='padding:150px' class='col-lg-12'><center>Loading<div></div><div></div><div></div><div></div></div></center></div>").fadeTo(5,1,function(){
        $.ajax({
            url: url,
            cache: false,
            type: "GET",
            success: function(data){
               $("#"+showTo).html(data);
            }
        });
    });

    return false;
} 

function loadPage2(url, showTo)
 {
    $('#'+showTo).html('').append("<center><div style='margin:0; padding:0' class='la-line-scale la-dark mt-0 mb-0'><div></div><div></div><div></div><div></div><div></div></div></center>").fadeTo(5,1,function(){
        $.ajax({
            url: url,
            cache: false,
            type: "GET",
            success: function(data){
               $("#"+showTo).html(data);
            }
        });
    });

    return false;
} 

function loadModal(url, showTo)
 {
    $('#'+showTo).html('').append("<div style='padding:150px' class='col-lg-12'><center><div class='la-line-scale la-dark text-gold mt-0 mb-0'><div></div><div></div><div></div><div></div><div></div></div></center></div>").fadeTo(5,1,function(){
        $.ajax({
            url: url,
            cache: false,
            type: "GET",
            success: function(data){
               $("#"+showTo).html(data);
            }
        });
    });

    return false;
} 


function loadElement(url, showTo)
{
  	$('#'+showTo).html('').append('<option>Loading...</option>').fadeTo(100,1,function(){
	    $.ajax({
	        url: url,
	        cache: false,
	        type: "GET",
	        success: function(data){
	        	// alert(data);
	           $("#"+showTo).html(data);
	        }
	    });
    });

    return false;
}