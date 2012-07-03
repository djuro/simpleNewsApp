$(document).ready(function(){

// ajax animacija
$("#ajxload").ajaxStart(function(){
  $(this).show();
});

$("#ajxload").ajaxStop(function(){
  $(this).hide();
});





$(".active_cbox").change(function(){

  var cb_chkd = $(this).attr('checked');
  
  var usr_id_obj = $(this).data();
  var usr_id = usr_id_obj['userid'];



  if(cb_chkd=='checked')
   {
    var usr_active = 1;
   }
  else
   {
    var usr_active = 0;
   }
  
  $.post("/sfproject/web/backend_dev.php/users/changepublished",{user_id:usr_id,usr_active:usr_active},function(data){
    //alert(data);
  });

});

});