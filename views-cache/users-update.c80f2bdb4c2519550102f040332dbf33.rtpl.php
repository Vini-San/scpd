<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
    <h4>
        <b>Editar Usuário</b>
    </h4>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/users">Consultar Todos Usuários</a></li>
        <li><a href="javascript:window.history.go(-1)">Voltar Anterior</a></li>
        <li class="active">Cadastrar</li>
    </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <!-- form start -->
                    <form role="form" action="/admin/users/<?php echo htmlspecialchars( $users["id_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
                        <div class="box-body">
                            <div class="col-12 col-sm-10 col-md-6">
                                <div class="form-group row">
                                    <div class="col-10 col-sm-5 col-md-8">
                                        <label for="nome_usuario" class="col-form-label col-form-label-sm">NOME DO USUÁRIO</label>
                                        <input type="hidden" class="form-control form-control-sm" id="id_usuario" name="id_usuario" value="<?php echo htmlspecialchars( $users["id_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"/>
                                        <input type="text" class="form-control form-control-sm" id="nome_usuario" name="nome_usuario" value="<?php echo htmlspecialchars( $users["nome_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-10 col-sm-5 col-md-8">
                                        <label for="cpf" class="col-form-label col-form-label-sm">LOGIN</label>
                                        <input type="text" class="form-control form-control-sm" id="cpf" name="cpf" value="<?php echo htmlspecialchars( $users["cpf"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-10 col-sm-5 col-md-8">
                                        <label for="email" class="col-form-label col-form-label-sm">E-MAIL</label>
                                        <input type="text" class="form-control form-control-sm" id="email" name="email" value="<?php echo htmlspecialchars( $users["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-10 col-sm-5 col-md-8">
                                        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                                        <button type="button" class="btn btn-primary btn-sm">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-0 col-sm-10 col-md-6">
                                <div class="form-group row">
                                    <div class="col-12 col-sm-12 col-md-2">
                                        <div class="col-sm-12 col-md-12">
                                            <label for="id_orgao" class="col-form-label col-form-label-sm">ÓRGÃO</label>
                                        </div>
                                        <div class="col-sm-12 col-md-12 text-black">
                                            <select class="btn btn-md btn-default" id="id_orgao" name="id_orgao" required>
                                                <option class="pl-3 pr-3" value="<?php echo htmlspecialchars( $users["id_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled selected><?php echo htmlspecialchars( $users["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                                <?php $counter1=-1;  if( isset($orgao) && ( is_array($orgao) || $orgao instanceof Traversable ) && sizeof($orgao) ) foreach( $orgao as $key1 => $value1 ){ $counter1++; ?>
                                                <option value="<?php echo htmlspecialchars( $value1["id_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 col-sm-12 col-md-2">
                                        <div class="col-sm-12 col-md-12">
                                            <label for="id_nivel_usuario" class="col-form-label col-form-label-sm">NÍVEL</label>
                                        </div>
                                        <div class="col-sm-12 col-md-12 text-black">
                                            <select class="btn btn-md btn-default" id="id_nivel_usuario" name="id_nivel_usuario" required>
                                                <option class="pl-3 pr-3" value="<?php echo htmlspecialchars( $users["id_nivel_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled selected><?php echo htmlspecialchars( $users["nivel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                                <?php $counter1=-1;  if( isset($nivel) && ( is_array($nivel) || $nivel instanceof Traversable ) && sizeof($nivel) ) foreach( $nivel as $key1 => $value1 ){ $counter1++; ?>
                                                <option value="<?php echo htmlspecialchars( $value1["id_nivel_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nivel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 col-sm-12 col-md-2">
                                        <div class="col-sm-12 col-md-12">
                                            <label for="id_situacao_usuario" class="col-form-label col-form-label-sm">SITUAÇÃO</label>
                                        </div>
                                        <div class="col-sm-12 col-md-12 text-black">
                                            <select class="btn btn-md btn-default" id="id_situacao_usuario" name="id_situacao_usuario" required>
                                                <option class="pl-3 pr-3" value="<?php echo htmlspecialchars( $users["id_situacao_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled selected><?php echo htmlspecialchars( $users["situacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                                <?php $counter1=-1;  if( isset($situacao) && ( is_array($situacao) || $situacao instanceof Traversable ) && sizeof($situacao) ) foreach( $situacao as $key1 => $value1 ){ $counter1++; ?>
                                                <option value="<?php echo htmlspecialchars( $value1["id_situacao_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["situacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->