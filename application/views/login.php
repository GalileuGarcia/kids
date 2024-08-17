<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="<?php echo $this->security->get_csrf_hash(); ?>">
        <title><?= TITULO_SISTEMA ?></title>
        <!-- Inclusão do Bootstrap via CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <link href="<?= base_url('assets/css/estilo.css')?>" rel="stylesheet">
        <base href="<?= base_url()?>" target="_self">
		
    </head>

    <body>
        <div class="container">
            <div id="blanket"></div>
            <div id="aguarde">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-4 login-container">
                    <!-- FORMULÁRIO DE LOGIN -->
                    <form method="POST" id="form-login">
                        <img src="<?= base_url('assets/img/logo-ibnb.png')?>" alt="Logo" width="70%">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Usuário</label>
                                    <input type="text" class="form-control" name="usuario" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Senha</label>
                                    <input type="password" class="form-control" name="senha" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" style="height: 60px; margin-top: 15px">ACESSAR SISTEMA</button>
                    </form>
                </div>
            </div>
            <!-- Inclusão do JavaScript do Bootstrap via CDN -->
            <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="<?= base_url('assets/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
            <script src="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>
            <script src="<?= base_url('assets/js/script.js') ?>"></script>
    </body>

</html>
