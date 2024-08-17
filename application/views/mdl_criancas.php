<br>
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table datatable">
				<thead class="thead-dark">
					<tr>
						<th scope="col">Nome</th>
						<th scope="col">Foto</th>
						<th scope="col">Sala</th>
						<th scope="col">Necessidades Especiais?</th>
						<th scope="col">Quais?</th>
						<th scope="col">Necessidades Alimentícias?</th>
						<th scope="col">Quais?</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($criancas as $vl) { ?>
						<tr>
							<td><?= $vl->nome ?></td>  
							<td>
								<?php if (!empty($vl->foto)) { ?>
									<div class="image-container">
										<img src="<?= $vl->foto ?>" alt="Imagem" class="rounded-image">
									</div>
								<?php } ?>
							</td>
							<td><?= sala($vl->idade) ?></td>
							<td><?= simNao($vl->necessidades_especiais) ?></td>
							<td><?= $vl->descricao_necessidades_especiais ?></td>
							<td><?= simNao($vl->necessidades_alimenticias) ?></td>
							<td><?= $vl->descricao_necessidades_alimenticias ?></td>
							<?php 
							
							$responsavel = tbl('criancas_responsavel', array(
								'id' => $vl->id_responsavel
							));
							
							?>
							<td>
								<button type="button" class="btn btn-secondary btn-editar" data-nome_responsavel="<?= $responsavel[0]->nome ?>" data-responsavel="<?= $vl->id_responsavel ?>" data-telefone="<?= $responsavel[0]->contato ?>" data-parentesco="<?= $responsavel[0]->id_parentesco ?>" data-id="<?= $vl->id ?>" data-sexo="<?= $vl->sexo ?>" data-foto="<?= $vl->foto ?>" data-necessidade="<?= $vl->necessidades_especiais ?>" data-alimenticia="<?= $vl->necessidades_alimenticias ?>"  data-idade="<?= $vl->idade ?>"><i class="fa-solid fa-pen-to-square"></i></button>
								<a href="<?= base_url('impressao?id='.$vl->id)?>" class="btn btn-info btn-imprimir-etiqueta" data-id="<?= $vl->id ?>"><i class="fa-solid fa-user-tag"></i></a>
								<button type="button" class="btn btn-danger btn-exclui-crianca" data-responsavel="<?= $vl->id_responsavel ?>" data-id="<?= $vl->id ?>"><i class="fa-solid fa-trash"></i></button>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal fade" id="mdl_editar" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-xxl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
					<form id="editar-form-cadastro">
						<?php $this->load->view('mdl_cadastro'); ?>	
					</form>
			</div>
		</div>
	</div>
</div>
