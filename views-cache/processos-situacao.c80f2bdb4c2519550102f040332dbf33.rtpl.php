<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h4>
            <b>SITUAÇÃO DO PROCESSO</b>
        </h4>
        <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home </a></li>
        <li><a href="/admin/processos">Consultar Todos</a></li>
        <li><a href="javascript:window.history.go(-1)">Voltar Anterior</a></li>
        <li class="active">Situação do Processo</li>
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
                                    <label for="numero_processo" class="col-form-label col-form-label-sm">NÚMERO DO PROCESSO:</label>
                                </div>
                                <div class="col-10 col-sm-6 col-md-6">
                                    <label for="numero_processo" class="col-form-label col-form-label-sm"><?php echo htmlspecialchars( $processo["numero_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-10 col-sm-5 col-md-4">
                                    <label for="id_orgao" class="col-form-label col-form-label-sm">ORGÃO DE ORIGEM:</label>
                                </div>
                                <div class="col-10 col-sm-5 col-md-6">
                                    <label for="numero_processo" class="col-form-label col-form-label-sm"><?php echo htmlspecialchars( $processo["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>    
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-10 col-sm-5 col-md-4">
                                    <label for="id_tipo_processo" class="col-form-label col-form-label-sm">TIPO DOCUMENTO:</label>
                                </div>
                                <div class="col-10 col-sm-6 col-md-8">
                                    <label for="numero_processo" class="col-form-label col-form-label-sm"><?php echo htmlspecialchars( $processo["tipo_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>
                                </div>
                            </div>
                            <a href="/admin/processos/<?php echo htmlspecialchars( $processo["id_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar os dados do processo</a> 
                        </div>
                        <div class="col-0 col-sm-10 col-md-6">
                            <div class="form-group row">
                                <div class="col-10 col-sm-5 col-md-3">
                                    <label for="data_inicio" class="col-form-label col-form-label-sm">DATA INICIO:</label>
                                </div>
                                <div class="col-8 col-sm-6 col-md-6">
                                    <label for="data_inicio" class="col-form-label col-form-label-sm"><?php echo formatDate($processo["data_inicio"]); ?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-10 col-sm-8 col-md-3">
                                    <label for="nome_processo" class="col-form-label col-form-label-sm">NOME:</label>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8">
                                    <label for="data_inicio" class="col-form-label col-form-label-sm"><?php echo htmlspecialchars( $processo["nome_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-10 col-sm-8 col-md-3">
                                    <label for="assunto_processo" class="col-form-label col-form-label-sm">ASSUNTO:</label>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8">
                                    <label for="assunto_processo" class="col-form-label col-form-label-sm"><?php echo htmlspecialchars( $processo["assunto_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>
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
                                    <?php $counter1=-1;  if( isset($movimento) && ( is_array($movimento) || $movimento instanceof Traversable ) && sizeof($movimento) ) foreach( $movimento as $key1 => $value1 ){ $counter1++; ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars( $value1["tipo_movimento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                        <td><?php echo htmlspecialchars( $value1["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                        <td><?php echo formatDate($value1["proc_data_entrada"]); ?></td>
                                        <td><?php echo htmlspecialchars( $value1["observacoes_proc_entrada"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                        <td>
                                            <a href="/admin/processos/<?php echo htmlspecialchars( $value1["id_movimento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/editarmovimento/<?php echo htmlspecialchars( $processo["id_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <a href="/admin/processos/movimentar/<?php echo htmlspecialchars( $processo["id_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Inserir Novo Movimento</a>     
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
      