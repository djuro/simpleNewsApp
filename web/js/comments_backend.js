$(document).ready(function(){

// ajax animacija
$("#ajxload").ajaxStart(function(){
  $(this).show();
});

$("#ajxload").ajaxStop(function(){
  $(this).hide();
});


// inicijalizira dialog box
$("#complete_text").dialog({autoOpen:false,modal:true,width:600,height:400});

 
// klik na "vise" na kraju odlomka teksta otvara dialog i puni ga tekstom clanka
 $(".comment_lnk").click(function(){

   var comm_id = $(this).data();
   //alert(comm_id);
   
   
// ajax posta ID clanka akciji i dobija nazad tekst i naslov clanka. Prikazuje i puni dialog box.
   $.post("/sfproject/web/backend_dev.php/comments/completetext",{comment_id:comm_id['idcomment']},function(data)
   {
     $("#complete_text").dialog('open');
     $("#complete_text").html(data);
     
   });

 });



$(".pub_cbox").change(function(){

  var cb_chkd = $(this).attr('checked');
  
  var comm_id_obj = $(this).data();
  var comm_id = comm_id_obj['commentid'];



  if(cb_chkd=='checked')
   {
    var publ = 1;
   }
  else
   {
    var publ = 0;
   }
  
  $.post("/sfproject/web/backend_dev.php/comments/changepublished",{comment_id:comm_id,published:publ},function(data){
    //alert(data);
  });

});

});