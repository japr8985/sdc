function cancel(){
  $("#username").val(''),
  $("#pass").val('')
}
function login() {
    var obj = {
      user : $("#username").val(),
      pass : $("#pass").val()
    };
    
    $.ajax({
       url:'php/session/login.php',
        method:'POST',
        data:obj,
        dataType:'json',
        success:function(data){
            if (data.Success){
              $.confirm({
                title:'Ha iniciado sesion',
                content:data.Msg,
                confirm:function(){
                    console.log('ok');
                    location.href = 'home.php'
                    },
                cancel:function(){
                    location.reload();
                }
              });
            }
            else{
              $.alert({
                title:'Error',
                content:data.Msg
              });
            }
            //location.href='home.php';
        },
        error:function(xhr,status,error){
            $.alert({
              title:'Error',
              content:xhr.status+" "+status+" "+error
            });
        }
    });
}