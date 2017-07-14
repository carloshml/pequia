$(document).ready(function(){


  function recebe_produto(){
    $.ajax({
          url: 'controllers/get_produtos.php',
          success: function(data){
            $('#produtos').html(data);

          }
        });
      }



  recebe_produto();




});
