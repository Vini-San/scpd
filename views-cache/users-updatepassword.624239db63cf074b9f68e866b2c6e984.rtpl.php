<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
    <h4>
        <b>Trocar Senha de Usuário</b>
    </h4>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/users">Consultar Todos Usuários</a></li>
        <li class="active">Cadastrar</li>
    </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <!-- form start -->
                    <form role="form" action="/admin/updatepassword/<?php echo htmlspecialchars( $user["id_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
                        <div class="box-body">
                            <div class="col-12 col-sm-10 col-md-6">
                                <div class="form-group row">
                                    <div class="col-10 col-sm-5 col-md-8">
                                        <label for="nome_usuario" class="col-form-label col-form-label-sm">NOME DO USUÁRIO</label>
                                        <input type="hidden" class="form-control form-control-sm" id="id_usuario" name="id_usuario" value="<?php echo htmlspecialchars( $user["id_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"/>
                                        <input type="text" class="form-control form-control-sm" id="nome_usuario" name="nome_usuario" value="<?php echo htmlspecialchars( $user["nome_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-10 col-sm-5 col-md-8">
                                        <label for="cpf" class="col-form-label col-form-label-sm">NOVA SENHA</label>
                                        <input type="password" class="form-control form-control-sm" id="senha" name="senha" placeholder="Digite Nova Senha" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-10 col-sm-5 col-md-8">
                                        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                                        <button type="button" class="btn btn-primary btn-sm">Cancelar</button>
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