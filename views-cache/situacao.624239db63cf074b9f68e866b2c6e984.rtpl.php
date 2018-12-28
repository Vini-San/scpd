<?php if(!class_exists('Rain\Tpl')){exit;}?>    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        SITUAÇÃO DO PROCESSO
        </h1>
        <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">atual</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <form role="form" action="/admin/users/create" method="post">
                        <div class="box-body">
                            <div class="col-12 col-sm-10 col-md-6">
                                <div class="form-group row">
                                    <div class="col-10 col-sm-5 col-md-4">
                                        <label for="numero_processo" class="col-form-label col-form-label-sm">NÚMERO DO PROCESSO:</label>
                                    </div>
                                    <div class="col-10 col-sm-6 col-md-6">
                                        <label for="numero_processo" class="col-form-label col-form-label-sm"><?php echo htmlspecialchars( $user["numero_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-10 col-sm-5 col-md-4">
                                        <label for="id_orgao" class="col-form-label col-form-label-sm">ORGÃO DE ORIGEM:</label>
                                    </div>
                                    <label for="numero_processo" class="col-form-label col-form-label-sm"><?php echo htmlspecialchars( $user["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>
                                </div>
                                <div class="form-group row">
                                    <div class="col-10 col-sm-5 col-md-4">
                                        <label for="id_tipo_processo" class="col-form-label col-form-label-sm">TIPO DOCUMENTO:</label>
                                    </div>
                                    <div class="col-10 col-sm-6 col-md-8">
                                        <label for="numero_processo" class="col-form-label col-form-label-sm"><?php echo htmlspecialchars( $user["tipo_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-0 col-sm-10 col-md-6">
                                <div class="form-group row">
                                    <div class="col-10 col-sm-5 col-md-3">
                                        <label for="data_inicio" class="col-form-label col-form-label-sm">DATA INICIO:</label>
                                    </div>
                                    <div class="col-8 col-sm-6 col-md-6">
                                        <label for="data_inicio" class="col-form-label col-form-label-sm"><?php echo htmlspecialchars( $user["data_inicio"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-10 col-sm-8 col-md-3">
                                        <label for="nome_processo" class="col-form-label col-form-label-sm">NOME:</label>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-8">
                                        <label for="data_inicio" class="col-form-label col-form-label-sm"><?php echo htmlspecialchars( $user["nome_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-10 col-sm-8 col-md-3">
                                        <label for="assunto_processo" class="col-form-label col-form-label-sm">ASSUNTO:</label>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-8">
                                        <label for="assunto_processo" class="col-form-label col-form-label-sm"><?php echo htmlspecialchars( $user["assunto_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box box-body">
                            <div class="col-12 col-sm-10 col-md-12">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>TIPO DE MOVIMENTO</th>
                                            <th>Órgão</th>
                                            <th>Data</th>
                                            <th style="width: 300px">Observações</th>
                                            <th>Opção</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>ENTRADA</td>
                                            <td>DGI</td>
                                            <td>2017-10-25</td>
                                            <td>Algo que alguém vai escrever</td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>SAÍDA</td>
                                            <td>DGI</td>
                                            <td>2017-10-25</td>
                                            <td>Algo que alguém vai escrever</td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table> 
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="dropdown">
                                <button type="button" class="btn btn-info btn-sm" data-toggle="collapse" data-target="#entrada" aria-expanded="false" aria-controls="entrada">
                                        INSERIR NOVO MOVIMENTO
                                        <span class="caret"></span>
                                </button>
                            </div>
                            <div class="collapse" id="entrada">
                                <div class="content bg-primary">
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-md-12">
                                            <label class="col-form-label col-form-label-sm ">TIPO DE MOVIMENTO:</label>
                                        </div>
                                        <div class="col-sm-12 col-md-12 text-black">
                                            <select class="custom-select custom-select-sm" required>
                                                <option value="" disabled selected>SELECIONE</option>
                                                <option value="1">ENTRADA</option>
                                                <option value="2">SAÍDA</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-4">
                                            <div class="form-group row">
                                                <div class="col-sm-12 col-md-12">
                                                    <label class="col-form-label col-form-label-sm">Data:</label>
                                                </div>
                                                <div class="col-sm-12 col-md-12">
                                                    <input type="date" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-3">
                                            <div class="form-group row">
                                                <div class="col-sm-12 col-md-12">
                                                    <label class="col-form-label col-form-label-sm">Hora:</label>
                                                </div>
                                                <div class="col-sm-12 col-md-12">
                                                    <input type="time" class="form-control form-control-sm" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-5">
                                            <div class="form-group row">
                                                <div class="col-sm-12 col-md-12">
                                                    <label class="col-form-label col-form-label-sm ">SELECIONE ORGÃO:</label>
                                                </div>
                                                <div class="col-sm-12 col-md-12 text-black">
                                                    <select class="custom-select custom-select-sm" required>
                                                        <option value="" disabled selected>SELECIONE</option>
                                                        <option value="1">DETTRRAN</option>
                                                        <option value="2">CEFFEET</option>
                                                        <option value="3">FETPW</option>
                                                        <option value="4">SADDA</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-10 col-md-12">
                                            <label class="col-form-label col-form-label-sm">Observações:</label>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <input type="text" class="form-control form-control-sm" required/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-10 col-md-12 mb-2">
                                            <button class="btn btn-info btn-sm" type="submit">Salvar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Your Page Content Here -->
    </section>
        <!-- /.content -->
</div>
      <!-- /.content-wrapper -->
      