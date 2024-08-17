<br>
<div class="row">
    <div class="col-sm-12 col-md-3">
        <div class="form-group">
            <label>Nome da Criança <i class="fa-solid fa-user"></i></label>
            <input type="text" class="form-control placa letrasMaiusculas" name="nome" placeholder="Digite o nome da criança" required autocomplete="off">
            <p class="text-helper">O campo é obrigatório</p>
        </div>
    </div>
    <div class="col-sm-12 col-md-2">
        <div class="form-group">
            <label>Data de Nascimento <i class="fa-solid fa-calendar"></i></label>
            <input type="date" class="form-control" value="<?= date('Y-m-d')?>" name="idade" placeholder=""  autocomplete="off" required>
        </div>
    </div>
    <div class="col-sm-12 col-md-2">
        <div class="form-group">
            <label>Sexo <i class="fa-solid fa-user-group"></i></label>
            <select class="form-control" name="sexo">
                <option value="M">MASCULINO</option>
                <option value="F">FEMININO</option>
            </select>
        </div>
    </div>
    <div class="col-sm-12 col-md-3">
        <label>Nome do Responsável <i class="fa-regular fa-user"></i></label>
        <div class="form-group">
            <input type="text" class="form-control placa letrasMaiusculas" name="nome_responsavel" placeholder="Digite o nome do responsável" required autocomplete="off">
            <p class="text-helper">O campo é obrigatório</p>
        </div>
    </div>
    <div class="col-sm-12 col-md-2">
        <div class="form-group">
            <label>Parentesco <i class="fa-solid fa-users"></i></label>
            <select class="form-control" name="parentesco">
                <?php $tbl = tbl('parentesco'); ?>
                <?php foreach ($tbl as $key => $vl) { ?>
                    <option value="<?= $vl->id ?>"><?= $vl->descricao ?></option>
                <?php } ?>
            </select>
            <p class="text-helper">O campo é obrigatório</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-2">
        <div class="form-group">
            <label>Whatsapp Responsável <i class="fa-brands fa-whatsapp"></i></label>
            <input type="tel" class="form-control telefone" name="telefone" placeholder="Telefone/Whatsapp Responsável" autocomplete="off">
            <p class="text-helper">O campo é obrigatório</p>
        </div>
    </div>
    <div class="col-sm-12 col-md-2">
        <div class="form-group">
            <label>Necessidades Especiais ? <i class="fa-solid fa-universal-access"></i> </label>
            <select class="form-control" name="necessidades" id="necessidades">
                <option value="S">SIM</option>
                <option value="N" selected>NÃO</option>
            </select>
        </div>
    </div>
    <div class="col-sm-12 col-md-3">
        <div class="form-group">
            <label>Quais as necessidades? <i class="fa-solid fa-universal-access"></i></label>
            <input type="text" class="form-control" name="descricao_necessidades" placeholder="" disabled autocomplete="off">
        </div>
    </div>
    <div class="col-sm-12 col-md-2">
        <div class="form-group">
            <label>Necessidades Alimentícias ? <i class="fa-solid fa-utensils"></i> </label>
            <select class="form-control" name="necessidades_alimenticias" id="necessidades_alimenticias">
                <option value="S">SIM</option>
                <option value="N" selected>NÃO</option>
            </select>
        </div>
    </div>
    <div class="col-sm-12 col-md-3">
        <div class="form-group">
            <label>Quais as necessidades? <i class="fa-solid fa-utensils"></i></label>
            <input type="text" class="form-control" name="descricao_necessidades_alimenticias" disabled="" autocomplete="off">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-2">
        <div class="box-img"></div>
        <div class="caixa"></div>
        <canvas id="canvasElement" width="220" class="canvasElement" style="display: none; border-radius: 10px; width: 100%; transform: scaleX(-1);"></canvas>
        <div class="row">
            <div class="col-md-6">
                <button id="openModalButton" class="btn btn-success btn-tirar-foto"><i class="fa-solid fa-camera"></i></button>
            </div>
            <div class="col-md-6">
                <button id="exclui-foto" class="btn btn-danger btn-tirar-foto"><i class="fa-solid fa-trash"></i></button>
            </div>
        </div>

    </div>
    <input type="hidden" name="foto">
    <input type="hidden" name="id">
    <input type="hidden" name="id_parentesco">
</div>
<hr>
<div class="row">
    <div class="col-sm-12 col-md-2 col-lg-2">
        <button type="submit" class="btn btn-primary">SALVAR <i class="fa-solid fa-floppy-disk"></i></button>
    </div>
</div>
