<?php
  session_start();
  if (!isset($_SESSION['id_usuario'])){
    header("Location: ../index.php?erro=2");
  }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Contatos-PHP</title>
    <!-- Bootstrap core CSS -->
    <link href="../assets/bootstrap-4.5.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/fontawesome-free-5.15.1-web/css/all.min.css" rel="stylesheet">
    <link href="../assets/css/styles.css" rel="stylesheet" />
    <script src="../assets/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
    $('#meuModal').on('shown.bs.modal', function() {
        $('#meuInput').trigger('focus')
    })
    $(document).ready(function() {
        $('#btn_salvar_contato').click(function() {
            console.log($('#form_contato').serialize());
            $.ajax({
                url: '../modal/usuarios-dao.php',
                method: 'post',
                data: $('#form_contato').serialize(),
                success: function(data) {
                    console.log('modal criacao', data);
                    const validacao = JSON.parse(data);
                    console.log('modal criacao', validacao);
                    if (validacao[0].valido) {
                        $('#meuModal').modal('hide');
                        atualizarContatos();
                    } else {
                        $('#erro_nome').html('');
                        $('#erro_endereco').html('');
                        $('#erro_telefone').html('');
                        $('#erro_email1').html('');
                        $('#erro_email2').html('');
                        $('#erro_sexo').html('');
                        $('#erro_login').html('');
                        $('#erro_senha').html('');
                        $('#erro_senha2').html('');
                        if (validacao[1].temErro) {
                            $('#erro_nome').html(validacao[1].motivo);
                        }
                        if (validacao[2].temErro) {
                            $('#erro_endereco').html(validacao[2].motivo);
                        }
                        if (validacao[3].temErro) {
                            $('#erro_telefone').html(validacao[3].motivo);
                        }
                        if (validacao[4].temErro) {
                            $('#erro_email1').html(validacao[4].motivo);
                        }
                        if (validacao[5].temErro) {
                            $('#erro_email2').html(validacao[5].motivo);
                        }
                        if (validacao[6].temErro) {
                            $('#erro_sexo').html(validacao[6].motivo);
                        }
                        if (validacao[7].temErro) {
                            $('#erro_senha').html(validacao[7].motivo);
                        }
                        if (validacao[8].temErro) {
                            $('#erro_senha2').html(validacao[8].motivo);
                        }
                        if (validacao[9].temErro) {
                            $('#erro_login').html(validacao[9].motivo);
                        }
                    }
                }
            });
        });

        // verificar login para não usar o mesmo usuario
        $("#in_m_c_login").keyup(function() {
            $.ajax({
                url: '../modal/usuarios-dao.php',
                method: 'get',
                data: {'verificar-login':true,'login': $("#in_m_c_login").val()},
                success: function(data) {
                    $('#erro_login').html(data);                  
                }
            });    
        });

        $('#btn-deletar-contato-concluir').click(function() {
            $.ajax({
                url: '../modal/delete.php',
                method: 'get',
                data: 'id=' + this.getAttribute('idDeletar'),
                success: function(data) {
                    $('#modal_delete').modal('hide');
                    atualizarContatos();
                }
            });
        });

        $('#btn_abrir_modal_para_inserir').click(function() {
            $('#in_m_c_nome').val('');
            $('#in_m_c_endereco').val('');
            $('#in_m_c_telefone').val('');
            $('#in_m_c_email').val('');
            $('#in_m_c_senha').val('');
            $('#in_m_c_senha2').val('');
            $('#in_m_c_login').val('');
            $('#sexoM').attr('checked', 'checked');
            $('#erro_nome').html('');
            $('#erro_endereco').html('');
            $('#erro_telefone').html('');
            $('#erro_email1').html('');
            $('#erro_email2').html('');
            $('#erro_sexo').html('');
            $('#erro_senha').html('');
            $('#erro_senha2').html('');
            $('#erro_login').html('');

        });

        $('#btn_concluir_update_contato').click(function() {
            const idContato = this.getAttribute('idUpdate');
            console.log(' updatate  M>>> ', 'id=' + idContato + '&' + $('#form_contato_update')
                .serialize());
            $.ajax({
                url: '../modal/update.php',
                method: 'post',
                data: 'id=' + idContato + '&' + $('#form_contato_update').serialize(),
                success: function(data) {
                    console.log('up up up', data);
                    const validacao = JSON.parse(data);
                    if (validacao[0].valido) {
                        $('#modal_update').modal('hide');
                        atualizarContatos();
                    } else {
                        $('#erro_nomeup').html('');
                        $('#erro_enderecoup').html('');
                        $('#erro_telefoneup').html('');
                        $('#erro_email1up').html('');
                        $('#erro_email2up').html('');
                        $('#erro_loginup').html('');
                        $('#erro_sexoup').html('');
                        if (validacao[1].temErro) {
                            $('#erro_nomeup').html(validacao[1].motivo);
                        }
                        if (validacao[2].temErro) {
                            $('#erro_enderecoup').html(validacao[2].motivo);
                        }
                        if (validacao[3].temErro) {
                            $('#erro_telefoneup').html(validacao[3].motivo);
                        }
                        if (validacao[4].temErro) {
                            $('#erro_email1up').html(validacao[4].motivo);
                        }
                        if (validacao[5].temErro) {
                            $('#erro_email2up').html(validacao[5].motivo);
                        }
                        if (validacao[6].temErro) {
                            $('#erro_sexoup').html(validacao[6].motivo);
                        }
                        if (validacao[7].temErro) {
                            $('#erro_loginup').html(validacao[7].motivo);
                        }
                    }
                }
            });
        });

        function atualizarContatos() {
            $.ajax({
                url: '../modal/atualizar.php',
                success: function(data) {
                    $('#todo_contatos').html(data);
                    // colocado aqui pois só aqui os elementos existem
                    $('.btn_apaga_contato').click(function() {
                        const id_contato = this.id.split('_')[1];
                        console.log('clichou id_contato', id_contato)
                        document.getElementById('btn-deletar-contato-concluir')
                            .setAttribute('idDeletar', id_contato);
                    });

                    $('.btn_ler_contato').click(function() {
                        const id_contato = this.id.split('_')[1];
                        $.ajax({
                            url: '../modal/read.php',
                            method: 'get',
                            data: 'id=' + id_contato,
                            success: function(data) {
                                data = JSON.parse(data);
                                $('#rd_nome_contato').html(data.nome);
                                $('#rd_endereco_contato').html(data.endereco);
                                $('#rd_telefone_contato').html(data.telefone);
                                $('#rd_email_contato').html(data.email);
                                $('#rd_sexo_contato').html(data.sexo);
                                $('#rd_login_contato').html(data.login);
                            }
                        });
                    });


                    $('.btn_update_contato').click(function() {
                        const id_contato = this.id.split('_')[1];
                        console.log(' updat ', id_contato);
                        $.ajax({
                            url: '../modal/read.php',
                            method: 'get',
                            data: 'id=' + id_contato,
                            success: function(data) {
                                document.getElementById(
                                        'btn_concluir_update_contato')
                                    .setAttribute('idUpdate', id_contato);
                                data = JSON.parse(data);
                                console.log(data);
                                $('#input_id_contato').val(data.id);
                                $('#input_nome_contato').val(data.nome);
                                $('#input_login_contato').val(data.login);
                                $('#input_endereco_contato').val(data.endereco);
                                $('#input_telefone_contato').val(data.telefone);
                                $('#input_email_contato').val(data.email);
                                if (data.sexo == "M") {
                                    $('#sexo_M').attr('checked', 'checked');
                                } else {
                                    $('#sexo_F').attr('checked', 'checked');
                                }
                            }
                        });
                    });
                }
            });
        }
        atualizarContatos();
    });
    </script>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Pequiá</a>
        <div class="form-inline">
            <a href="index.php" class="btn btn-outline-secondary">Dashboard </a>
            <a href="publicar.php" class="btn btn-outline-secondary">Publicar </a>
            <a href="sair.php" class="btn btn-outline-warning"> <i class="fas fa-sign-out-alt"></i> </a>
        </div>
    </nav>
    <div class="container">
        <div class="form-row">
            <div class="col">
                <h2>Usuários</h2>
            </div>
            <div class="col text-right">
                <button id="btn_abrir_modal_para_inserir" type="button" class="btn btn-success " data-toggle="modal"
                    data-target="#meuModal">
                    novo
                </button>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Login</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Sexo</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody id="todo_contatos">
                <!--  os contatos aqui são gerado dinamicamento com a funcao  atualizarContatos(); -->
            </tbody>
        </table>
    </div>
    </div>
    <!-- Bootstrap core JavaScript -->
    <!-- Bootstrap core JS -->
    <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->



    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js">
    </script>
    <script src="../assets/fontawesome-free-5.15.1-web/js/all.js"> </script>
    <!-- Core theme JS
     <script src="../assets/js/scripts.js"></script> -->
</body>

</html>

</html>


<!-- Modal Create -->
<div class="modal fade" id="meuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar Contato</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div clas="span10 offset1">
                        <div class="card">
                            <div class="card-body">
                                <form id="form_contato" class="form-horizontal">
                                    <!-- action="index.php" method="post" -->
                                    <div class="control-group">
                                        <label class="control-label">Nome</label>
                                        <div class="controls">
                                            <input id="in_m_c_nome" size="50" class="form-control" name="nome"
                                                type="text" placeholder="Nome" required="" value=" ">
                                            <span id="erro_nome" class="help-inline text-warning"></span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Login</label>
                                        <div class="controls">
                                            <input id="in_m_c_login" size="50"  autocomplete="off" class="form-control" name="login"
                                                type="text" placeholder="login" required="" value=" ">
                                            <span id="erro_login" class="help-inline text-warning"></span>
                                        </div>
                                    </div>
                                    <div class="control-group ">
                                        <label class="control-label">Endereço</label>
                                        <div class="controls">
                                            <input id="in_m_c_endereco" size="80" class="form-control" name="endereco"
                                                type="text" placeholder="Endereço" required="" value=" ">
                                            <span id="erro_endereco" class="help-inline text-warning"></span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="control-group ">
                                                <label class="control-label">Telefone</label>
                                                <div class="controls">
                                                    <input id="in_m_c_telefone" size="35" class="form-control"
                                                        name="telefone" type="text" placeholder="Telefone" required=""
                                                        value="">
                                                    <span id="erro_telefone" class="help-inline text-warning"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="control-group ">
                                                <label class="control-label">Email</label>
                                                <div class="controls">
                                                    <input id="in_m_c_email" size="40" class="form-control" name="email"
                                                        type="text" placeholder="Email" required="" value="">
                                                    <span id="erro_email1" class="help-inline text-warning"></span>
                                                    <span id="erro_email2" class="help-inline text-warning"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="control-group ">
                                                <label class="control-label">Senha</label>
                                                <div class="controls">
                                                    <input id="in_m_c_senha" size="80" class="form-control" name="senha"
                                                        type="password" placeholder="senha" required="true" value="">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="control-group ">
                                                <label class="control-label">Repita a Senha</label>
                                                <div class="controls">
                                                    <input id="in_m_c_senha2" size="80" class="form-control"
                                                        name="senha2" type="password" placeholder="senha"
                                                        required="true" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span id="erro_senha" class="help-inline text-warning"></span>
                                    <span id="erro_senha2" class="help-inline text-warning"></span>
                                    <div class="control-group ">
                                        <label class="control-label">Sexo</label>
                                        <span id="erro_sexo" class="help-inline text-warning"></span>
                                        <div class="controls">
                                            <div class="form-check">
                                                <p class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="sexo" id="sexoM"
                                                        value="M" /> Masculino
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="sexo" id="sexoF"
                                                    value="F" /> Feminino
                                            </div>
                                            </p>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btn_salvar_contato" class="btn btn-success">Adicionar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal  Delete-->
<div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Deseja Deletar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div clas="span10 offset1">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button id="btn-deletar-contato-concluir" class="btn btn-danger">deletar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal  informacao-->
<div class="modal fade" id="modal_read" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informações do Contato</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="span10 offset1">
                        <div class="card">

                            <div class="container">
                                <div class="form-horizontal">
                                    <div class="control-group">
                                        <label class="control-label">Nome</label>
                                        <div class="controls">
                                            <label class="carousel-inner" id="rd_nome_contato"> </label>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">login</label>
                                        <div class="controls">
                                            <label class="carousel-inner" id="rd_login_contato"> </label>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Endereço</label>
                                        <div class="controls">
                                            <label class="carousel-inner" id="rd_endereco_contato"> </label>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Telefone</label>
                                        <div class="controls">
                                            <label class="carousel-inner" id="rd_telefone_contato"> </label>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Email</label>
                                        <div class="controls">
                                            <label class="carousel-inner" id="rd_email_contato"> </label>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Sexo</label>
                                        <div class="controls">
                                            <label class="carousel-inner" id="rd_sexo_contato"> </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal  Update-->
<div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Atualizar Contato</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div clas="span10 offset1">
                        <div class="card">
                            <div class="card-body">
                                <form id="form_contato_update" class="form-horizontal">
                                    <!-- action="index.php" method="post" -->


                                    <div class="form-row">
                                        <div class="col col-md-2">
                                            <div class="control-group">
                                                <label class="control-label">Cód</label>
                                                <div class="controls">
                                                    <input disabled id="input_id_contato" size="50" class="form-control"
                                                        name="id" type="text" placeholder="Cód" required="">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="control-group">
                                                <label class="control-label">Nome</label>
                                                <div class="controls">
                                                    <input size="50" id="input_nome_contato" class="form-control"
                                                        name="nome" type="text" placeholder="Nome" required="">
                                                    <span id="erro_nomeup" class="help-inline text-warning"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group ">
                                            <label class="control-label">login</label>
                                            <div class="controls">
                                                <input size="80" id="input_login_contato" class="form-control"
                                                    name="login" type="text" placeholder="login" required="">
                                                <span id="erro_loginup" class="help-inline text-warning"></span>
                                            </div>
                                        </div>
                                        <div class="control-group ">
                                            <label class="control-label">Endereço</label>
                                            <div class="controls">
                                                <input size="80" id="input_endereco_contato" class="form-control"
                                                    name="endereco" type="text" placeholder="Endereço" required="">
                                                <span id="erro_enderecoup" class="help-inline text-warning"></span>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="control-group ">
                                                    <label class="control-label">Telefone</label>
                                                    <div class="controls">
                                                        <input size="35" id="input_telefone_contato"
                                                            class="form-control" name="telefone" type="text"
                                                            placeholder="Telefone" required="">
                                                        <span id="erro_telefoneup"
                                                            class="help-inline text-warning"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="control-group ">
                                                    <label class="control-label">Email</label>
                                                    <div class="controls">
                                                        <input size="40" id="input_email_contato" class="form-control"
                                                            name="email" type="text" placeholder="Email" required="">
                                                        <span id="erro_email1up"
                                                            class="help-inline text-warning"></span>
                                                        <span id="erro_email2up"
                                                            class="help-inline text-warning"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group ">
                                            <label class="control-label">Sexo</label>
                                            <div class="controls">
                                                <span id="erro_sexoup" class="help-inline text-warning"></span>
                                                <div class="form-check">
                                                    <p class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="sexo"
                                                            value="M" id="sexo_M" /> Masculino
                                                    </p>
                                                </div>
                                                <div class="form-check">
                                                    <p class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="sexo"
                                                            value="F" id="sexo_F" /> Feminino
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button id="btn_concluir_update_contato" type="button" class="btn btn-success">Atualizar</button>
                </div>
            </div>
        </div>
    </div>