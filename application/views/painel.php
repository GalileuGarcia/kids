<?php $this->load->view('commons/head'); ?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-dark topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>


            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                         aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small"
                                       placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-white">Projeção</span>
                        <img class="img-profile rounded-circle" src="assets/img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                         aria-labelledby="userDropdown">
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('logout') ?>">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Sair
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-white">Notificações</h1>
            </div>

            <div class="row aviso-painel">
                <?php if (empty($avisos)): ?>
                    <div class="col-md-3">
                        <div class="alert alert-info" role="alert">
                            <i class="fa-solid fa-circle-exclamation"></i> Nenhum aviso cadastrado
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($avisos as $aviso): ?>
                        <div class="col-md-3 aviso-<?php echo $aviso->id; ?>" style="margin-bottom: 3%">
                            <div class="card border-left-primary shadow py-2" style="border-radius: 20px">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">

                                            <div class="font-weight-bold text-uppercase mb-1">
                                                <?php echo $aviso->aviso; ?>
                                            </div>
                                            <div class="mb-0 font-weight-bold text-gray-800">
                                                CRIADO POR: <?php echo $aviso->criado; ?>
                                            </div>
                                            <a href="#" class="btn btn-primary btn-circle btn-copiar-texto"
                                               data-texto="<?= $aviso->aviso ?> ">
                                                <i class="fa-regular fa-copy"></i>
                                            </a>
                                            <a href="#" class="btn btn-success btn-circle btn-concluir"
                                               data-id="<?= $aviso->id ?>">
                                                <i class="fas fa-check"></i>
                                            </a>
                                            <?php if (!empty($aviso->imagem)) { ?>
                                                <a href="#" class="btn btn-info btn-circle btn-img"
                                                   data-id="<?= $aviso->id ?>">
                                                    <i class="fa-solid fa-image"></i>
                                                </a> 
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="modal fade" id="img-painel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="img-centro">
                                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <?php $this->load->view('commons/footer'); ?>
    <script src="https://www.gstatic.com/firebasejs/9.14.0/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.14.0/firebase-messaging-compat.js"></script>
    <script type="module">
        const firebaseConfig = {
            apiKey: "AIzaSyDtllkaja26Vqt3atlkh1F0ItlomI-pPpk",
            authDomain: "notifica-midia.firebaseapp.com",
            projectId: "notifica-midia",
            storageBucket: "notifica-midia.appspot.com",
            messagingSenderId: "749588664531",
            appId: "1:749588664531:web:6e4b13611fcef1f0c68426",
            measurementId: "G-G8LVEG4W0J"
        };
        const app = firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();
        window.Notification.requestPermission().then(function (permission) {
            if (permission == "granted") {
                messaging.getToken({
                    vapidKey: "BP3vX370bdBE1QxcLlZYBMRPOouipKmrV7EfG5Z8QVZokaFxKmE_ysyJhUmkUxlSv1E7yd5zQztTQLU-iPyt0CI"
                }).then((currentToken) => {
                    sendTokenToServer(currentToken)
                }).catch((err) => {
                    setTokenSentToServer(false)
                })
            }
        });

        function sendTokenToServer(currentToken) {
            if (!isTokenSentToServer()) {
                console.log('Enviando o TOKEN para o servidor ...');
                $.ajax({
                    data: {
                        token_push: currentToken
                    },
                    type: "POST",
                    dataType: 'json',
                    url: 'token',
                    success: function (data) {

                    }
                });
                setTokenSentToServer(true)
            } else {
                console.log('O token já está salvo no servidor');
            }
        }

        function isTokenSentToServer() {
            return window.localStorage.getItem('sentToServer') === '1'
        }

        function setTokenSentToServer(sent) {
            window.localStorage.setItem('sentToServer', sent ? '1' : '0')
        }
    </script>
