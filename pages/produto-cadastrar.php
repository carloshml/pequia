<?php
session_start();
include_once('../controllers/produto-controller.php');
include_once('componente-login.php');
$temEditar = 0;
$response = '';

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Pequia - Novo Produto</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="../assets/fontawesome-free-5.15.1-web/js/all.js" crossorigin="anonymous"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../assets/css/styles.css" rel="stylesheet" />
    <link href="../assets/css/estilo.css" rel="stylesheet" />
    <script src="../assets/js/script-local.js"></script>
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3a0ca3;
            --success: #4cc9f0;
            --info: #7209b7;
            --warning: #f72585;
            --light: #f8f9fa;
            --dark: #212529;
            --gradient-start: #4361ee;
            --gradient-mid: #3a0ca3;
            --gradient-end: #7209b7;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(-45deg, var(--gradient-start), var(--gradient-mid), var(--gradient-end));
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            min-height: 100vh;
            color: white;
            overflow-x: hidden;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .navbar {
            background: rgba(255, 255, 255, 0.1) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }

        .main-container {
            padding-top: 8em;
            padding-bottom: 3em;
        }

        .page-title {
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .form-container {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 8px;
            padding: 0.75rem 1rem;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
            color: white;
            box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.1);
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .help-text {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }

        .preview-container {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
            border: 2px dashed rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .preview-container:hover {
            border-color: rgba(255, 255, 255, 0.4);
        }

        .img-preview {
            max-height: 200px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .img-preview:hover {
            transform: scale(1.02);
        }

        .btn-modern {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 50px;
            padding: 0.75rem 2rem;
            transition: all 0.3s ease;
            font-weight: 500;
            margin-right: 1rem;
        }

        .btn-modern:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .btn-primary {
            background: var(--primary);
            border: none;
        }

        .btn-primary:hover {
            background: #3651d3;
        }

        .btn-reset {
            background: rgba(255, 255, 255, 0.05);
        }

        .btn-reset:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .contact-section {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 3rem 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            margin-top: 3rem;
        }

        .divider {
            border-color: rgba(255, 255, 255, 0.2);
        }

        .contact-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: rgba(255, 255, 255, 0.9);
            transition: all 0.3s ease;
        }

        .contact-icon:hover {
            transform: translateY(-5px);
            color: white;
        }

        .floating-element {
            position: absolute;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            z-index: -1;
        }

        .floating-1 {
            top: 15%;
            left: 5%;
            animation: float 6s ease-in-out infinite;
        }

        .floating-2 {
            bottom: 20%;
            right: 5%;
            animation: float 8s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(10deg);
            }

            100% {
                transform: translateY(0) rotate(0deg);
            }
        }

        @media (max-width: 768px) {
            .main-container {
                padding-top: 7em;
            }

            .page-title {
                font-size: 2rem;
            }

            .floating-element {
                display: none;
            }

            .btn-modern {
                width: 100%;
                margin-bottom: 1rem;
                margin-right: 0;
            }
        }
    </style>
    <script type="text/javascript">
        if (!localStorage.getItem('usuario_nome')) {
            window.location.href = '../index.php?erro=1';
        }
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById('imagem_file').addEventListener('change', function (event) {
                const file = event.target.files[0];
                const preview = document.getElementById('imagem-produto-preview');

                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    preview.src = '';
                    preview.style.display = 'none';
                }
            });
        });
    </script>
</head>

<body id="page-top">
    <!-- Navigation-->
    <script>
        const a = document.getElementById('page-top').innerHTML;
        document.getElementById('page-top').innerHTML = nav() + a;
    </script>
    <div id="wrapper">

        <h1 class="page-header">Publicar Produto</h1>
        <div class="container">
            <div class="row">
                <div class="col-1">
                </div>
                <div class="col">
                    <form method="post"
                        action="../controllers/produto-cadastrar.php?temEdicao=<?= $temEditar ?>&id_produto=<?= $id_produto ?>"
                        id="formCadastrarse" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Escreva o Nome do Produto</label>
                            <input id="nome_produto" name="produto" class="form-control" required>
                            <p class="help-block">Pode ser o nome do produto</p>
                        </div>
                        <div class="form-group">
                            <label>Escreva um Subtítulo</label>
                            <input id="subtitulo" name="subtitulo" class="form-control">
                            <p class="help-block">Será a frase abaixo do título</p>
                        </div>
                        <div class="form-group">
                            <div class="row align-items-center mb-4">
                                <div class="col-md-6 col-sm-12">

                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label>Pré-visualização da Nova Imagem</label>
                                    <div class="mb-3 text-center">
                                        <img id="imagem-produto-preview"
                                            class="img-fluid rounded border border-warning shadow-sm img-produto" src=""
                                            alt="Pré-visualização"
                                            style="max-height: 200px; transition: transform 0.3s;">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="imagem_file">Selecione Uma Foto</label>
                                <input type="file" id="imagem_file" name="imagem" class="form-control" accept="image/*">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Fale sobre o Produto</label>
                            <textarea id="descricao" name="descricao" maxlength="250" class="form-control"
                                rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Preço: </label>
                            <input type="number" id="preco_venda" name="precovenda" maxlength="7" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Tag 1</label>
                            <input id="tag1" name="tag1" class="form-control" placeholder="classifique uma tag">
                        </div>
                        <div class="form-group">
                            <label>Tag 2</label>
                            <input id="tag2" name="tag2" class="form-control" placeholder="classifique uma tag">
                        </div>
                        <div class="form-group">
                            <label>Tag 3</label>
                            <input id="tag3" name="tag3" class="form-control" placeholder="classifique uma tag">
                        </div>
                        <div class="form-group">
                            <label>Tag 4</label>
                            <input id="tag4" name="tag4" class="form-control" placeholder="classifique uma tag">
                        </div>
                        <div class="form-group">
                            <label>Tag 5</label>
                            <input id="tag5" name="tag5" class="form-control" placeholder="classifique uma tag">
                        </div>

                        <button type="submit" class="btn btn-primary">Publicar</button>
                        <button type="reset" class="btn btn-primary">Limpar Campos</button>
                    </form>
                </div>
            </div>
        </div>
        <section id="contact">
            <div class="container">
                <hr class="divider my-4" />
                <h2 class="text-center mt-0">Nossos Contatos</h2>
                <hr class="divider my-4" />
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center">
                        <p class="mb-5">Pronto pra comprar biojoias conosco, nos ligue ou envie um e-mail.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 ml-auto text-center">
                        <i class="fa fa-phone fa-3x mb-3 sr-contact"></i>
                        <p>(63) 3554-8989</p>
                    </div>
                    <div class="col-lg-4 ml-auto text-center">
                        <i class="fab fa-whatsapp fa-3x mb-3 sr-contact"></i>
                        <p>(63) 3554-8989</p>
                    </div>
                    <div class="col-lg-4 mr-auto text-center">
                        <i class="fa fa-envelope fa-3x mb-3 sr-contact"></i>
                        <p>
                            <a href="mailto:your-email@your-domain.com">pequia@yahoo.com</a>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- /#wrapper -->
        <!-- Bootstrap core JavaScript -->
        <!-- Bootstrap core JS -->
        <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

        <script src="../assets/js/jquery-3.5.1.min.js"></script>

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