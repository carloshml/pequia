<?php
session_start();
include_once('componente-login.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Pequia - Gerenciamento de Usuários</title>
    <!-- Bootstrap core CSS -->
    <link href="../assets/bootstrap-4.5.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Using Font Awesome CDN instead of local file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="../assets/css/styles.css" rel="stylesheet" />
    <script src="../assets/js/jquery-3.5.1.min.js"></script>
    <script src="../assets/js/script-local.js"></script>
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #6f42c1;
            --success-color: #1cc88a;
            --danger-color: #e74a3b;
            --warning-color: #f6c23e;
            --info-color: #36b9cc;
        }

        body {
            background-color: #f8f9fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .page-header {
            border-bottom: 1px solid #e3e6f0;
            padding-bottom: 1rem;
            margin-bottom: 2rem;
        }

        .card {
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            border: 1px solid #e3e6f0;
            margin-bottom: 1.5rem;
        }

        .card-header {
            background-color: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
            font-weight: 600;
        }

        .table-container {
            background: white;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            overflow: hidden;
        }

        .table th {
            border-top: none;
            font-weight: 600;
            color: #5a5c69;
            padding: 0.75rem;
            background-color: #f8f9fc;
        }

        .table td {
            padding: 0.75rem;
            vertical-align: middle;
        }

        .btn-table {
            width: 36px;
            height: 36px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 5px;
        }

        .btn-new {
            background-color: var(--success-color);
            border-color: var(--success-color);
            font-weight: 600;
        }

        .btn-new:hover {
            background-color: #17a673;
            border-color: #17a673;
        }

        .badge-admin {
            background-color: var(--secondary-color);
        }

        .badge-client {
            background-color: var(--info-color);
        }

        .modal-header {
            background-color: var(--primary-color);
            color: white;
        }

        .control-label {
            font-weight: 500;
            margin-bottom: 0.3rem;
        }

        .form-control {
            border-radius: 0.35rem;
            padding: 0.5rem 0.75rem;
        }

        .help-inline {
            font-size: 0.85rem;
        }

        @media (max-width: 768px) {
            .table-responsive {
                font-size: 0.875rem;
            }

            .btn-table {
                width: 32px;
                height: 32px;
                font-size: 0.875rem;
            }

            .actions-column {
                min-width: 120px;
            }
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-weight: bold;
        }
    </style>
</head>

<body id="page-top">
    <!-- Navigation-->
    <script>
        const a = document.getElementById('page-top').innerHTML;
        document.getElementById('page-top').innerHTML = nav() + a;
    </script>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header mt-4">
                    <div class="row align-items-center">
                        <div class="col">
                            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-users mr-2"></i>Gerenciamento de Usuários
                            </h1>
                        </div>
                        <div class="col-auto">
                            <button id="btn_abrir_modal_para_inserir" type="button" class="btn btn-new"
                                data-toggle="modal" data-target="#meu_modal">
                                <i class="fas fa-plus mr-2"></i>Novo Usuário
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Lista de Usuários</h6>
                        <div class="input-group" style="width: 250px;">
                            <input type="text" class="form-control" placeholder="Pesquisar..." aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-container">
                            <div class="table-responsive">
                                <table class="table table-hover" id="contactsTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Usuário</th>
                                            <th scope="col">Login</th>
                                            <th scope="col">Endereço</th>
                                            <th scope="col">Contato</th>
                                            <th scope="col">Tipo</th>
                                            <th scope="col" class="actions-column">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody id="todo_contatos">
                                        <!-- os contatos aqui são gerado dinamicamente com a função atualizarContatos(); -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        // Your JavaScript code remains the same, just updating the table row generation
        function atualizarContatos() {
            var myInit = {
                method: 'GET',
                headers: {},
                cache: 'default'
            };
            fetch(`../controllers/usuarios-controller.php?atulizar-usuarios=true`, myInit)
                .then(response => {
                    var contentType = response.headers.get("content-type");
                    if (contentType && contentType.indexOf("application/json") !== -1) {
                        return response.json().then(function (usuarios) {
                            let textoUsu = '';
                            for (const usuario of usuarios) {
                                const nomeIniciais = usuario.nome.split(' ').map(n => n[0]).join('').toUpperCase();
                                const tipoBadge = usuario.tipo === 'ADMINISTRADOR' ?
                                    '<span class="badge badge-admin">ADMIN</span>' :
                                    '<span class="badge badge-client">CLIENTE</span>';

                                textoUsu += '<tr>';
                                textoUsu += '<td>' + usuario.id + '</td>';
                                textoUsu += '<td><div class="user-avatar">' + nomeIniciais.substring(0, 2) + '</div>' + usuario.nome + '</td>';
                                textoUsu += '<td>' + usuario.login + '</td>';
                                textoUsu += '<td>' + (usuario.endereco || '-') + '</td>';
                                textoUsu += '<td><div>' + (usuario.telefone || '-') + '</div><small class="text-muted">' + usuario.email + '</small></td>';
                                textoUsu += '<td>' + tipoBadge + '</td>';
                                textoUsu += '<td>';
                                textoUsu += '<a class="btn btn-info btn-table btn_ler_contato" id="btnrd_' + usuario.id + '" data-toggle="modal" data-target="#modal_read" title="Visualizar"><i class="fas fa-eye"></i></a>';
                                textoUsu += '<a class="btn btn-warning btn-table btn_update_contato" id="btnupdt_' + usuario.id + '" data-toggle="modal" data-target="#modal_update" title="Editar"><i class="fas fa-edit"></i></a>';
                                textoUsu += '<a class="btn btn-danger btn-table btn_apaga_contato" id="btndlt_' + usuario.id + '" data-toggle="modal" data-target="#modal_delete" title="Excluir"><i class="fas fa-trash"></i></a>';
                                textoUsu += '</td>';
                                textoUsu += '</tr>';
                            }
                            $('#todo_contatos').html(textoUsu);
                        });
                    } else {
                        console.log("Oops, we haven't got JSON!");
                    }
                })
                .catch(e => {
                    console.log('error:  ', e);
                });
        }

        // Event handlers moved outside the atualizarContatos function
        $(document).ready(function () {
            // Delegate event handlers using `.on()` — this binds to *future* rows
            $('#contactsTable tbody').on('click', '.btn_apaga_contato', function () {


                const id_contato = this.id.split('_')[1];
                document.getElementById('btn-deletar-contato-concluir')
                    .setAttribute('idDeletar', id_contato);
            });

            $('#btn_abrir_modal_para_inserir').click(function () {
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

            $('#btn_concluir_update_contato').click(function () {
                const idContato = $('#btn_concluir_update_contato').attr('data-id');
                $.ajax({
                    url: '../controllers/update-usuario.php',
                    method: 'post',
                    data: 'id=' + idContato + '&' + $('#form_contato_update').serialize(),
                    success: function (resposta) {
                        const validacao = resposta;
                        if (validacao.valido) {
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

            $('#contactsTable tbody').on('click', '.btn_ler_contato', function () {
                const id_user = this.id.split('_')[1];
                $.ajax({
                    url: `../controllers/usuarios-controller.php`,
                    method: 'get',
                    data: 'id=' + id_user,
                    success: function (usuario) {
                        $('#rd_nome_contato').html(usuario.nome);
                        $('#rd_endereco_contato').html(usuario.endereco);
                        $('#rd_telefone_contato').html(usuario.telefone);
                        $('#rd_email_contato').html(usuario.email);
                        $('#rd_sexo_contato').html(usuario.sexo);
                        $('#rd_login_contato').html(usuario.login);
                    }
                });
            });

            $('#btn_salvar_contato').click(function () {
                $.ajax({
                    url: `../controllers/usuarios-controller.php`,
                    method: 'post',
                    data: $('#form_contato').serialize(),
                    success: function (data) {
                        console.log('data salvar ', data);
                        const validacao = data.error;
                        if (validacao[0].valido !== 'false') {
                            $('#meu_modal').modal('hide');
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

            $('#contactsTable tbody').on('click', '.btn_update_contato', function () {
                const id_user = this.id.split('_')[1];
                $.ajax({
                    url: `../controllers/usuarios-controller.php`,
                    method: 'GET',
                    data: 'id=' + id_user,
                    dataType: 'json',
                    success: function (data) {
                        $('#input_id_contato').attr('value', id_user);
                        $('#btn_concluir_update_contato').attr('data-id', id_user);
                        $('#input_id_user').val(data.id);
                        $('#input_nome_contato').val(data.nome);
                        $('#input_login_contato').val(data.login);
                        $('#input_endereco_contato').val(data.endereco);
                        $('#input_telefone_contato').val(data.telefone);
                        $('#input_email_contato').val(data.email);
                        $('#sexo_M').prop('checked', data.sexo === 'M');
                        $('#sexo_F').prop('checked', data.sexo === 'F');
                    },
                    error: function (xhr, status, error) {
                        console.error('Error loading contact for edit:', error);
                    }
                });
            });

            // Initialize the contacts
            atualizarContatos();
        });
    </script>
</body>

</html>

<!-- Modal Create -->
<div class="modal fade" id="meu_modal" tabindex="-1" role="dialog" aria-labelledby="Modais" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Modais">Adicionar Contato</h5>
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
                                                type="text" placeholder="Nome" required="" value="">
                                            <span id="erro_nome" class="help-inline text-warning"></span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Login</label>
                                        <div class="controls">
                                            <input id="in_m_c_login" size="50" autocomplete="off" class="form-control"
                                                name="login" type="text" placeholder="login" required="" value="">
                                            <span id="erro_login" class="help-inline text-warning"></span>
                                        </div>
                                    </div>
                                    <div class="control-group ">
                                        <label class="control-label">Endereço</label>
                                        <div class="controls">
                                            <input id="in_m_c_endereco" size="80" class="form-control" name="endereco"
                                                type="text" placeholder="Endereço" required="" value="">
                                            <span id="erro_endereco" class="help-inline text-warning"></span>
                                        </div>
                                    </div>
                                    <div class="control-group ">
                                        <label class="control-label">Tipo:</label>
                                        <div class="controls">
                                            <select class="form-select" aria-label="Tipo de cliente" name="tipo" id="">
                                                <option value="CLIENTE"> CLIENTE </option>
                                                <option value="ADMINISTRADOR"> ADMINISTRADOR </option>
                                            </select>
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
<div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="Modais" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Modais">Deseja Deletar</h5>
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
<div class="modal fade" id="modal_read" tabindex="-1" role="dialog" aria-labelledby="Modais" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Modais">Informações do Contato</h5>
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
<div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="Modais" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Modais"> Atualizar Contato</h5>
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
                                                        name="codigo" type="text" placeholder="Cód">
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