<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./view/css/header.css" />
    <link rel="stylesheet" href="./view/css/general.css" />
    <link rel="stylesheet" href="./view/css/footer.css" />
    <link rel="stylesheet" href="./view/css/responsividade.css" />

    <script src="./js/dropdown.js"></script>
    <!-- Kit do fontawesome para ícones -->
    <script src="https://kit.fontawesome.com/b4d8cbf4fd.js" crossorigin="anonymous"></script>
    <title>Sportsync - Cadastro</title>
</head>

<body class="inter">
    <header>
        <ul class="nav-bar">
            <li class="logo jockey-one-regular"><a href="#">SPORTSYNC</a></li>
            <li><a href="index.php">Home</a></li>
            <li><a href="ranking.html">Instituições</a></li>
            <li><a href="#">Associe-se</a></li>
            <li><a href="#">Parceiros</a></li>
            <li><a href="./view/cadastro_usuario.php">Cadastrar</a></li>
            <li><a href="./view/perfil.php">Perfil</a></li>
            <!--PERFIL NO HEADER PROVISORIO ATE BOTAR O JS PRA QUANDO USUARIO TIVER LOGADO ELE APARECER E CADASTRO+LOGIN SUMIR!!!!-->
            <li class="login"><a href="./view/login.php">Login</a></li>
        </ul>
        <div class="dropmenu">
            <span class="logo jockey-one-regular">SPORTSYNC</span>
            <div class="dropdown">
                <img onclick="Dropdown()" class="dropbtn" src="./icons/bars-solid.svg" />
                <div id="myDropdown" class="dropdown-content">
                    <a href="index.php">Home</a>
                    <a href="ranking.html">Instituições</a>
                    <a href="#">Associe-se</a>
                    <a href="#">Parceiros</a>
                    <a href="./view/cadastrar_usuario.php">Cadastrar</a>
                    <li><a href="./view/perfil.php">Perfil</a></li>
                    <a href="./view/login.php">Login</a>
                </div>
            </div>
        </div>
    </header>
    <div class="section-conheça">
        <div class="text-button">
            <div class="text-conheça">Descubra uma nova forma de ajudar! Conheça nosso site, onde cada compra gera <span
                    id="destaque1">impacto.</span></div>

        </div>
        <!-- <div class="img-homem">
          <video id="video-homem" src="assets/video-teste.webm" muted></video>
        </div> -->
    </div>
    <div class="section-conheça">
        <button id="button-conheça">Saiba mais</button>
    </div>
    <div class="section-box-text">
        <div class="box-text">
            Imagine um lugar onde cada compra <br>contribui para o futuro do esporte.<br>
            Acumule pontos, <span id="destaque2">ganhe descontos</span> e <br>
            ajude a transformar vidas.
        </div>
    </div>

    <div class="section-ranking">
        <img src="./view/assets/fundo-ranking.png" alt="Imagem de Fundo">
        <div class="text-section-ranking">
            <div class="text-container">
                <h1>Descubra os jovens<br> talentos que você pode<br> impulsionar</h1>
                <button class="action-btn">Apoie e Ganhe</button>
            </div>
        </div>
    </div>

    <section class="plano-sessao">
        <div class="texto-central">
            <h1>Experimente fazer a diferença</h1>
            <p>Faça parte do time <span>SportSync</span> e gere impacto com o seu valor.</p>
        </div>
        <div class="cards-container">
            <div class="card">
                <h2>PLANO ATLETA</h2>
                <hr>
                <ul class="beneficios">
                    <li>Descontos em compras: De 10% à 20%</li>
                    <li>Multiplicador de pontos: 0.8x</li>
                    <li>Conteúdo Exclusivo: Nenhum</li>
                    <li>Valor mensal: R$14,90</li>
                    <li>Valor anual: R$120,00</li>
                </ul>
                <hr>
                <button>Seja sócio por R$14,90</button>
                <p id="anualmente">Ou pague R$120,00 anualmente</p>
                <p id="termos">Leia os <span id="destaque3">Termos de compra</span> ao adquirir o plano.</p>
            </div>
            <div class="card">
                <h2>PLANO ESPORTISTA</h2>
                <hr>
                <ul class="beneficios">
                    <li>Descontos em compras: De 20% à 30%</li>
                    <li>Multiplicador de pontos: 1.2x</li>
                    <li>Conteúdo Exclusivo: Sorteio de Kits</li>
                    <li>Valor mensal: R$17,90</li>
                    <li>Valor anual: R$199,00</li>
                </ul>
                <hr>
                <button>Seja sócio por R$17,90</button>
                <p id="anualmente">Ou pague R$199,00 anualmente</p>
                <p id="termos">Leia os <span id="destaque3">Termos de compra</span> ao adquirir o plano.</p>
            </div>
        </div>
    </section>
    <footer>
        <div class="box-footer">
            <div class="footer-column">
                <h3>Organização</h3>
                <ul>
                    <li><a href="#"><span id="destaque-f">Política de Privacidade</span></a></li>
                    <li><a href="#">Diretrizes da comunidade</a></li>
                    <li><a href="#">Fale conosco</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Recursos</h3>
                <ul>
                    <li><a href="#">Serviços</a></li>
                    <li><a href="#">Seja um colaborador</a></li>
                    <li><a href="#">Assine nossa newsletter</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Redes Sociais</h3>
                <div class="social-icons">
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-x"></i></a>
                    <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="#"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>
        </div>
        <hr class="footer-divider">
        <div class="footer-bottom">
            <p>Sportsync © 2024 - Todos os direitos reservados.</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const iconmenu = document.getElementById("icon-menu");
            const navlinks = document.getElementById("nav-links");
            const closemenu = document.getElementById("close-menu");
            const image = document.querySelector('.img-homem img');
            const video = document.getElementById('video-homem');

            if (iconmenu && navlinks && closemenu) {
                iconmenu.addEventListener('click', function () {
                    if (navlinks.style.display === 'none' || navlinks.style.display === '') {
                        navlinks.style.display = 'block';
                    } else {
                        navlinks.style.display = 'none';
                    }
                });

                closemenu.addEventListener('click', function () {
                    navlinks.style.display = 'none';
                });
            }

            if (image) {
                image.addEventListener('mouseenter', function (event) {
                    const { left, right } = image.getBoundingClientRect();
                    const mouseX = event.clientX;

                    if (mouseX < (left + right) / 2) {
                        image.style.transform = 'rotateY(-15deg)';
                    } else {
                        image.style.transform = 'rotateY(15deg)';
                    }
                });

                image.addEventListener('mouseleave', function () {
                    image.style.transform = 'rotateY(0deg)';
                });
            }

            // Script para controle do vídeo
            if (video) {
                video.play();
                video.addEventListener('ended', function () {
                    video.pause(); // Pausa o vídeo após ele terminar
                });
            }
        });
    </script>
    <style type="text/css" href="index.css">
        <?php include('./view/css/style.css'); ?>
    </style>
</body>

</html>