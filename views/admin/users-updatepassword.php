<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
    <h4>
        <b>Cadastro de Novo Usuário</b>
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
                    <form role="form" action="/admin/users/{$user.id_usuario}" method="post">
                        <div class="box-body">
                            <div class="col-12 col-sm-10 col-md-6">
                                <div class="form-group row">
                                    <div class="col-10 col-sm-5 col-md-8">
                                        <label for="nome_usuario" class="col-form-label col-form-label-sm">NOME DO USUÁRIO</label>
                                        <input type="hidden" class="form-control form-control-sm" id="id_usuario" name="id_usuario" value="{$user.id_usuario}"/>
                                        <input type="text" class="form-control form-control-sm" id="nome_usuario" name="nome_usuario" value="{$user.nome_usuario}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-10 col-sm-5 col-md-8">
                                        <label for="cpf" class="col-form-label col-form-label-sm">CPF</label>
                                        <input type="text" class="form-control form-control-sm" id="cpf" name="cpf" value="{$user.cpf}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-10 col-sm-5 col-md-8">
                                        <label for="email" class="col-form-label col-form-label-sm">E-MAIL</label>
                                        <input type="text" class="form-control form-control-sm" id="email" name="email" value="{$user.email}" required>
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
                                                <option class="pl-3 pr-3" value="{$user.id_orgao}" disabled selected>{$user.nome_orgao}</option>
                                                {loop="$orgao"}
                                                <option value="{$value.id_orgao}">{$value.nome_orgao}</option>
                                                {/loop}
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
                                                <option class="pl-3 pr-3" value="{$user.id_nivel_usuario}" disabled selected>{$user.nivel}</option>
                                                {loop="$nivel"}
                                                <option value="{$value.id_nivel_usuario}">{$value.nivel}</option>
                                                {/loop}
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
                                                <option class="pl-3 pr-3" value="{$user.id_situacao_usuario}" disabled selected>{$user.situacao}</option>
                                                {loop="$situacao"}
                                                <option value="{$value.id_situacao_usuario}">{$value.situacao}</option>
                                                {/loop}
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