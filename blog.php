<?php

    session_start();
    $urlAtual = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

?>

<!DOCTYPE html>
<html lang="pt_br">
<head>
    <!-- Responsive -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Icon -->
    <link rel="shortcut icon" href="./public/images/logo.png" type="image/x-icon" />

    <!-- Default CSS -->
    <link rel="stylesheet" href="./public/styles/default.css" />
    <link rel="stylesheet" href="./public/styles/espacamentos.css" />
    <link rel="stylesheet" href="./public/styles/navbar.css" />
    <link rel="stylesheet" href="./public/styles/colors.css" />
    <link rel="stylesheet" href="./public/styles/bordes.css" />
    <link rel="stylesheet" href="./public/styles/texts.css" />
    <link rel="stylesheet" href="./public/styles/displays.css" />
    <link rel="stylesheet" href="./public/styles/homepage.css" />
    <link rel="stylesheet" href="./public/styles/curso.css" />
    <link rel="stylesheet" href="./public/styles/faq.css" />
    <link rel="stylesheet" href="./public/styles/footer.css" />
    <link rel="stylesheet" href="./public/styles/blog.css" />
    <link rel="stylesheet" href="./public/styles/buttons.css" />

    <!-- Bulma -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css" />
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>

    <!-- SCRIPT MOBILE BUTTON -->
    <script src="./public/javascript/btn-mobile.js"></script>
    <!-- SCRIPT MODAL BUTTON -->
    <script src="./public/javascript/btn-modal.js"></script>
    <!-- SCRIPT FAQ BUTTON -->
    <script src="./public/javascript/btn-faq.js"></script>
    <!-- SCRIPT NOTIFICACAO -->
    <script src="./public/javascript/notificacao.js"></script>
    <!-- SCRIPT WRITE POST -->
    <script src="./public/javascript/btn-write-post.js"></script>

    <title>Ciência de Dados - FATEC</title>
</head>
<body>
    
    <!-- NAVBAR -->
    <header class="container">
        <nav class="navbar is-fixed-top padding-right padding-left bg-white" role="navigation" aria-label="main navegation">
            <div class="navbar-brand">
                <a href="index.php" class="navbar-item"><img src="./public/images/logo.png" alt="logo" style="max-height: 4rem"></a>
                <!-- MENU MOBILE -->
                <a role="button" class="navbar-burger btn-mobile" aria-label="menu" aria-expanded="false" data-target="navMenu">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>
            <!-- MENU DESKTOP -->
            <div id="navMenu" class="navbar-menu">
                <div class="navbar-start margin-left-short">
                    <a href="index.php#sobre" class="navbar-item">Sobre</a>
                    <a href="index.php#curso" class="navbar-item">Curso de Férias</a>
                    <a href="index.php#faq" class="navbar-item">Perguntas Frequentes</a>
                    <a href="blog.php" class="navbar-item">Blog</a>
                </div>

                <!-- BUTTONS OF NAVBAR END -->


                <?php if(isset($_SESSION['dados'])){ ?>
                    <?php if($_SESSION['dados']['is_admin'] == 1){$admin = 1; $id = $_SESSION['dados']['admin_id'];}else{$admin = 0; $id = $_SESSION['dados']['user_id'];} ?>
                    <!-- LOGADO  -->
                    <div class="navbar-end">
                        <div class="navbar-item">
                            <div>
                                <form action="user.php" method="post">
                                    <input type="hidden" name="admin" value="<?php echo $admin; ?>">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <label for="submit"><i class="far fa-user pointer"></i></label>
                                    <input id="submit" type="submit" value="enviar" class="display-none">
                                    <a href="controller/logout.php?a=<?php echo $urlAtual; ?>"><i class="fas fa-sign-out-alt color-purple"></i></a>
                                </form>      
                            </div>
                        </div>
                    </div>
                <?php } else{ ?>
                    <!-- SEM LOGAR -->
                    <div class="navbar-end">
                        <div class="navbar-item">
                            <div>
                                <a class="button btn-login" onClick="openModal('modalRegistro')"><strong>Cadastar</strong></a>
                                <a class="button btn-login" onClick="openModal('modalLogar')">Entrar</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <?php if(isset($_SESSION['sucess_conta_criada'])): ?>
                    <div class="notification is-success is-light">
                        <button class="delete"></button>
                        Conta Criada com Sucesso!
                    </div>
                <?php endif; unset($_SESSION['sucess_conta_criada']);?>

            </div>
        </nav>
    </header>
    <!-- MODAL LOGIN -->
    <div class="modal" id="modalLogar">
        <div class="modal-background"></div>
            <div class="card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Entrar</p>

                    <!-- ERRO EMAIL INVÁLIDO -->
                    <?php if(isset($_SESSION['error_email_invalido'])): ?>
                        <h3 class="has-text-danger padding-standard">Insira um Email Válido!</h3>
                    <?php endif; unset($_SESSION['error_email_invalido']);?>

                    <!-- ERRO CONTA INEXISTENTE -->
                    <?php if(isset($_SESSION['conta_inexistente'])): ?>
                        <h3 class="has-text-danger padding-standard">Conta Inválida!</h3>
                    <?php endif; unset($_SESSION['conta_inexistente']); ?>

                </header>
                <section class="modal-card padding-standard">
                    <form method="post" action="controller/verifyLogin.php">
                        <div class="field">
                            <p class="control has-icons-left has-icons-right">
                                <input class="input" type="email" name="email" placeholder="Email">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </p>
                        </div>
                        
                        <div class="field">
                            <p class="control has-icons-left">
                                <input class="input" type="password" name="pass" placeholder="Password">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </p>

                            <input type="hidden" name="url" value="<?php echo $urlAtual; ?>">
                        </div>
                        <div class="padding-standart">
                            <input type="submit" class="input button bg-purple color-white" value="Entrar">
                        </div>                        
                    </form>
                </section>
            </div>
        <button class="modal-close is-large" aria-label="close" onClick="closeModal('modalLogar')"></button>
    </div>
    <!-- MODAL REGISTRAR -->
    <div class="modal" id="modalRegistro">
        <div class="modal-background"></div>
        <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Cadastrar-se</p>

                    <!-- ERRO EMAIL INVÁLIDO -->
                    <?php if(isset($_SESSION['error_email_invalido'])): ?>
                        <h3 class="has-text-danger padding-standard">Email Inválido!</h3>
                    <?php endif; unset($_SESSION['error_email_invalido']); ?>

                    <!-- ERRO EMAIL INEXISTENTE -->
                    <?php if(isset($_SESSION['error_email_invalido_registro'])): ?>
                        <h3 class="has-text-danger padding-standard">Email já Utilizado!</h3>
                    <?php endif; unset($_SESSION['error_email_invalido_registro']); ?>

                </header>
                <section class="modal-card-body">
                    <form method="post" action="controller/verifyCadastro.php">
                        
                        <div class="padding-standart">
                            <label class="label" for="nome">Nome</label>
                            <input type="text" class="input" name="nome" placeholder="Ex.: Felipe Cesar" />
                        </div>
                        <div class="padding-standart">
                            <label class="label" for="email">E-mail</label>
                            <input type="email" class="input" name="email" placeholder="Ex.: seunome@gmail.com" />
                        </div>
                        <div class="padding-standart">
                            <label class="label" for="senha">Senha</label>
                            <input type="text" class="input" name="pass" placeholder="Ex.: !2E21@HT" />
                        </div>
                        <input type="hidden" name="url" value="<?php echo $urlAtual; ?>">
                        <div class="padding-standart">
                            <input type="submit" class="input button bg-purple color-white margin-top" value="Cadastrar">
                        </div>
                    </form>
                </section>
            </div>
        <button class="modal-close is-large" aria-label="close" onClick="closeModal('modalRegistro')"></button>
    </div>


    <!-- HOMEPAGE -->
    <section class="hero banner is-halfheight" id="homepage">
        <div class="hero-body">
            <div class="padding-left title-banner">
                <p class="title color-white">
                    Blog<br>
                    Ciência de Dados
                </p> 

                <?php if(isset($_SESSION['dados'])): ?>
                    <a href="escrever.php"><button class="button is-medium is-fullwidth btn-banner">
                        <i class="fas fa-pencil-alt" style="margin-right: 10px;"></i>Escrever Post
                    </button></a>
                <?php endif; ?>

                
                <?php if(!isset($_SESSION['dados'])): ?>
                    <button class="button is-medium is-fullwidth btn-banner" onClick="write_login()">
                        <i class="fas fa-pencil-alt" style="margin-right: 10px;"></i>Escrever Post
                    </button>
                <?php endif; ?>

            </div>
        </div>
    </section>

    <!-- BLOG -->
    <main class="container" style="margin-bottom: 12%;">

        <h2 class="upper bold size-22 margin-top-short">Posts</h2>
        <div>

            <?php
            
            
                try{

                    $conn = new PDO('mysql:host=localhost;dbname=fatec', 'root', '');
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

                    $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
                    
                    $registros = 3;

                    $stmt = $conn->query("SELECT * FROM post WHERE post_postado = 1");

                    $totalRegistros = $stmt->rowCount();
                    $totalPaginas = ceil($totalRegistros / $registros);

                    $inicio = ($registros * $pagina) - $registros;
                    $limite = $conn->query("SELECT * FROM post WHERE post_postado = 1 ORDER BY post_date DESC LIMIT $inicio, $registros");

                    $anterior = $pagina - 1;
                    $proximo = $pagina + 1;

                    while($row = $limite->fetch(PDO::FETCH_ASSOC)){
                        
                        $date = new DateTime($row['post_date']);

                        echo "<div class='column is-full post border-radius'>";
                            echo "<div class='post-header'>";
                                echo "<h1>" . $row['post_title'] . "</h1>";
                                echo "<h2>" . $row['post_subtitle'] . "</h2>";
                                echo "<p>";
                                    echo $date->format('d/m/Y'); 
                                echo "</p>";
                            echo "</div>";

                            echo "<div class='post-footer'>";
                                echo "<a href='post.php?id_post=" . $row['post_id'] . "'>Ver Mais <i class='fas fa-angle-right'></i></a>";
                            echo "</div>";
                        echo "</div>"; 
                        
                    }
                    
                } catch(PDOException $e){
                    echo "Error" . $e->getMessage();
                }
            
            ?>
        </div>

        <div class="margin-top">
            <nav class="pagination" role="navigation" aria-label="pagination">

                <?php if($pagina > 1){ ?>

                    <a class="pagination-previous" href="?pagina=<?php echo $anterior; ?>" title="This is the first page">Anterior</a>

                <?php } else{?>

                    <a class="pagination-previous" title="This is the first page" disabled>Anterior</a>

                <?php } ?>


                <?php if($pagina == $totalPaginas){ ?>

                    <a class="pagination-next" disabled>Próxima Página</a>

                <?php } else{ ?>

                    <a class="pagination-next" href="?pagina=<?php echo $proximo; ?>">Próxima Página</a>

                <?php } ?>

                <ul class="pagination-list">

                <?php for($i = 1; $i <= $totalPaginas; $i++){
                    if($pagina == $i){
                        echo "<li><a class='pagination-link is-current' aria-current='page'  href='?pagina=$i'>$i</a></li>";
                    } else{
                        echo "<li><a class='pagination-link' href='?pagina=$i' aria-current='page'>$i</a></li>";
                    }
                } ?>

                </ul>
            </nav>
        </div>
    </main>

    <!-- RODAPÉ -->
    <footer class="footer banner">
        <div class="content container has-text-centered">
            <div class="columns">
                <div class="column is-half">
                    <ul>
                        <li><h3 class="color-white">Contato</h3></li>

                        <i class="far fa-envelope color-white"></i>
                        <li>diretoria@fatec.com</li>
                        <li>fatec@fatec.com</li>

                        <i class="fas fa-phone-alt color-white margin-top"></i>
                        <li>(14) 3323-3721</li>
                        <li>(14) 3343-2212</li>
                    </ul>
                </div>
                <div class="column is-half">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3673.9854558809243!2d-49.898355285371196!3d-22.950762745210884!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c01976077f0513%3A0x7469ad48478234ac!2sFatec%20Ourinhos!5e0!3m2!1spt-BR!2sbr!4v1614029425312!5m2!1spt-BR!2sbr" 
                    width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>  
        </div>
        <h6 class="color-white text-center margin-top">FATEC
            <strong><a href="https://www.fatecourinhos.edu.br/" target="_blank">Ourinhos</a></strong>
        </h6> 
        <h6 class="color-white text-center">Vestibular
            <strong><a href="https://www.vestibularfatec.com.br/" target="_blank">FATEC</a></strong>
        </h6> 
        <h6 class="color-white text-center">Desenvolvido por 
            <strong><a href="https://www.github.com/FeCesar" target="_blank">Felipe Cesar</a></strong>
        </h6>  
    </footer>


</body>
</html>