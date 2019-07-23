$(document).ready(function(){
     
  /*  $("#form_log_est").submit(function(e){
        var est=true;
        e.preventDefault();
        $.ajax({
             async: false,
            url: "index/logEst",
            type:"post",
            data:$(this).serialize(),
            success: function(data){
                if(data !=0){
                    $("#Errorlog").html(data).fadeIn(500).fadeOut(7000);
                    est=false;
                }
                    
                if(est==true){
                    window.location.replace('student');
                }
               
            return est;
                
            } 
         });
     
    });*/


$("#form_log_est").submit(function(e){
     var est=true;
    e.preventDefault();
   
     var idC=$("#carnet").val() , idpas=$("#password").val();
    $.ajax({
        async: false,
     url:"index/logEst",
     data: {"carnet" :idC, "password" :idpas },
     type: "POST",  
     success:(function(data){
        
         if(data!=0){
            
         $("#Errorlog").html(data).fadeIn(500).fadeOut(7000);
        
         est= false;
     }
     })
 });//fin de var idc

     var activo=$("#carnet").val(), actpas=$("#password").val();
    $.ajax({
        async: false,
     url:"index/verificarEstado",
     data: {"carnet" :activo, "password" :actpas  },
     type: "POST",  
     success:(function(data){
        
         if(data!=0){
            
         $("#Errorlog").html(data).fadeIn(500).fadeOut(7000);
        
         est= false;
     }
     })
 });//fin de var activo


if(est)
  window.location.replace('student');
return est;


});

    

//login profesor

    $("#form_log_prof").submit(function(p){
        var estate=true;
        p.preventDefault();
        $.ajax({
             async: false,
            url: "index/loginProf",
            type:"post",
            data:$(this).serialize(),
            success: function(data){
                if(data !=0){
                    $("#Errorlogp").html(data).fadeIn(500).fadeOut(7000);
                    estate=false;
                }
                    
                if(estate==true){
                    window.location.replace('profesor');
                }
               
            return estate;
                
            } 
         });
     
    });


});
