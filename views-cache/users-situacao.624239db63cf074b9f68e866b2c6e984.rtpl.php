<?php if(!class_exists('Rain\Tpl')){exit;}?>    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h4>
            <b>SITUAÇÃO DO USUÁRIO</b>
        </h4>
        <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home </a></li>
        <li><a href="/admin/users">Consultar Todos</a></li>
        <li><a href="javascript:window.history.go(-1)">Voltar Anterior</a></li>
        <li class="active">Dados do Usuário</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-body">
                        <div class="col-12 col-sm-10 col-md-6">
                            <div class="form-group row">
                                <div class="col-10 col-sm-5 col-md-4">
                                    <label for="nome_usuario" class="col-form-label col-form-label-sm">NOME DE USUÁRIO:</label>
                                    <input type="hidden" class="form-control form-control-sm" id="id_usuario" name="id_usuario" value="<?php echo htmlspecialchars( $user["id_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"/>
                                </div>
                                <div class="col-10 col-sm-6 col-md-6">
                                    <label for="nome_usuario" class="col-form-label col-form-label-sm"><?php echo htmlspecialchars( $user["nome_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-10 col-sm-5 col-md-4">
                                    <label for="cpf" class="col-form-label col-form-label-sm">LOGIN:</label>
                                </div>
                                <div class="col-10 col-sm-5 col-md-6">
                                    <label for="cpf" class="col-form-label col-form-label-sm"><?php echo htmlspecialchars( $user["cpf"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>    
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-10 col-sm-5 col-md-4">
                                    <label for="email" class="col-form-label col-form-label-sm">E-MAIL</label>
                                </div>
                                <div class="col-10 col-sm-6 col-md-8">
                                    <label for="email" class="col-form-label col-form-label-sm"><?php echo htmlspecialchars( $user["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>
                                </div>
                            </div>
                            <a href="/admin/users/<?php echo htmlspecialchars( $user["id_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar os dados do usuário</a>
                            <a href="/admin/updatepassword/<?php echo htmlspecialchars( $user["id_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Trocar Senha</a>
                        </div>
                        <div class="col-0 col-sm-10 col-md-6">
                            <div class="form-group row">
                                <div class="col-10 col-sm-8 col-md-3">
                                    <label for="id_orgao" class="col-form-label col-form-label-sm">ORGÃO DO USUÁRIO:</label>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8">
                                    <label for="id_orgao" class="col-form-label col-form-label-sm"><?php echo htmlspecialchars( $user["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-10 col-sm-8 col-md-3">
                                    <label for="id_nivel_usuario" class="col-form-label col-form-label-sm">NÍVEL:</label>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8">
                                    <label for="id_nivel_usuario" class="col-form-label col-form-label-sm"><?php echo htmlspecialchars( $user["nivel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-10 col-sm-8 col-md-3">
                                    <label for="id_situacao_usuario" class="col-form-label col-form-label-sm">SITUAÇÃO:</label>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8">
                                    <label for="id_situacao_usuario" class="col-form-label col-form-label-sm"><?php echo htmlspecialchars( $user["situacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Your Page Content Here -->
    </section>
        <!-- /.content -->
</div>
      <!-- /.content-wrapper -->
