<!DOCTYPE html>
<html lang="pt-BR">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?= TITULO_SISTEMA ?></title>
        <!-- Custom fonts for this template-->
        <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <!-- Custom styles for this template-->
        <link href="<?= base_url('assets/css/sb-admin-2.css') ?>" rel="stylesheet">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <link href="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/selectize/dist/css/selectize.bootstrap3.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css" rel="stylesheet">
        <link href="<?= base_url('assets/css/toastr.css') ?>" rel="stylesheet">
        <style>
            .modal-xxl {
                max-width: 94%; /* Adjust this percentage as needed */
            }
            .selectize-dropdown {
                display: none !important;
            }

            #videoElement,
            #canvasContainer {
                width: 100% !important;
                height: auto;
            }

            .caixa {
                width: 100%;
                height: 180px;
                background-color: #bdbdbd;
                border-radius: 10px;
            }

            .btn-tirar-foto {
                margin-top: 10px;
                width: 100%;
            }

            @media screen and (max-width: 768px) {

                /* Aplica estilos quando a largura da tela for menor que 768px */
                .btn-tirar-foto {
                    margin-top: 10px;
                    /* Margem menor para telas menores */
                    width: 100%;
                }
            }

            /* Define um contêiner para centralizar a imagem, se necessário */
            .image-container {
                display: flex;
            }

            /* Estiliza a imagem com bordas arredondadas */
            .rounded-image {
                border-radius: 50%;
                /* Faz com que a imagem fique completamente redonda */
                width: 80px;
                /* Ajusta o tamanho da imagem conforme necessário */
                height: 80px;
                /* Certifique-se de que a largura e a altura sejam iguais para uma imagem circular */
                object-fit: cover;
                /* Garante que a imagem preencha o contêiner de forma adequada */
            }
        </style>
        <base href="<?= base_url() ?>" target="_self">
    </head>

    <body id="page-top" class="sidebar-toggled">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-black sidebar sidebar-dark accordion toggled" id="accordionSidebar">
                <br>
                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() ?>">
                    <img src="https://www.igrejabatistanovabelem.com.br/inscricao/assets/img/logo/logo.png" alt="Logo" width="70%">
                </a>
                <br>
                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('cadastrar') ?>">
                        <i class="fas fa-user"></i>
                        <span>Cadastro de Criança</span>
                    </a>
                    <?php if (!empty($this->session->userdata('usuario'))) { ?>
                    <hr class="sidebar-divider">
                    <a class="nav-link" href="<?= base_url('painel') ?>">
                        <i class="fas fa-user"></i>
                        <span>Crianças</span>
                    </a>
                    <?php } ?>
                </li>

                <!-- Divider -->
                

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>
            <!-- End of Sidebar -->
