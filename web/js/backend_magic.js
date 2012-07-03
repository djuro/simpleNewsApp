$(document).ready(function(){


$("#ajxload").ajaxStart(function(){
	$(this).show();
});

$("#ajxload").ajaxStop(function(){
	$(this).hide();
});

// inicijalizira dialog box
$("#complete_text").dialog({autoOpen:false,modal:true,width:600,height:400});

 
// klik na "vise" na kraju odlomka teksta otvara dialog i puni ga tekstom clanka
 $(".article_lnk").click(function(){

   var artcl_id = $(this).data();

   
   
// ajax posta ID clanka akciji i dobija nazad tekst i naslov clanka. Prikazuje i puni dialog box.
   $.post("/sfproject/web/backend.php/articles/completetext",{artcl_id:artcl_id['idartcl']},function(data)
   {
   	 $("#complete_text").dialog('open');
     $("#complete_text").dialog("option", "title", "Article Text");
     $("#complete_text").html(data);
     
   });

 });

// klik na checkbox 'Published' mijenja stanje 'published' ili ne u bazi
$(".pub_cbox").change(function(){

  var cb_chkd = $(this).attr('checked');
  
  var art_id_obj = $(this).data();
  var art_id = art_id_obj['articleid'];

  

  if(cb_chkd=='checked')
   {
   	var publ = 1;
   }
  else
   {
   	var publ = 0;
   }
  
  $.post("/sfproject/web/backend.php/articles/changepublished",{article_id:art_id,published:publ},function(data){
  	//alert(data);
  });

});


$(".show_photo").click(function(){

  
  var artcl_id = $(this).data();

  $.post("/sfproject/web/backend.php/articles/retrievephoto",{article_id:artcl_id['artclid']},function(data){
    //alert(data);
     var img_html = '<img src="/sfproject/web/uploads/'+data+'">';
     $("#complete_text").dialog('open');
     $("#complete_text").dialog("option", "title", "Article Photo");
     $("#complete_text").html(img_html);
  });

});


});