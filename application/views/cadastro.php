<?php $this->load->view('commons/head'); ?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

	<!-- Main Content -->
	<div id="content" style="background-color: whitesmoke">

		<?php $this->load->view('commons/menu'); ?>

		<!-- Begin Page Content -->
		<div class="container-fluid">
			<!-- Page Heading -->
			<div class="d-sm-flex align-items-center justify-content-between mb-4">
				<h1 class="h3 mb-0 text-gray-800">Painel de Crianças</h1>
			</div>

			<ul class="nav nav-tabs" id="myTabs">
				<li class="nav-item">
					<a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1">Crianças</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2">Cadastrar</a>
				</li>
			</ul>   

			<div class="tab-content mt-2">
				<div class="tab-pane fade" id="tab2">
					<form id="form-cadastro">
						<?php $this->load->view('commons/mdl_cadastro'); ?>	
					</form>
				</div>
				<div class="tab-pane fade show active" id="tab1">
					<?php $this->load->view('commons/mdl_criancas'); ?>
				</div>
				<div class="modal fade" id="webcamModal" tabindex="-1" aria-labelledby="webcamModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<video id="videoElement" class="videoElement" playsinline style="border-radius: 20px; transform: scaleX(-1);"></video>

								<div class="row">
									<div class="col-md-12">
										<button id="captureButton" class="btn btn-success" style="width: 100%;">TIRAR FOTO</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /.container-fluid -->
	</div>
	<?php $this->load->view('commons/footer'); ?>
