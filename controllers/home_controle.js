function recebe_produto(){
  $.ajax({
        url: '../controllers/get_quantidate_produtos.php',
        success: function(data){
          $('#numero_produtos').html(data);

        }
      });
    }
recebe_produto();
