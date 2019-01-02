<?php if(!class_exists('Rain\Tpl')){exit;}?>    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        SITUAÇÃO DO PROCESSO
        </h1>
        <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li><a href="/admin/users">Consultar Todos</a></li>
        <li class="active">Movimentar Processo</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <form role="form" action="/admin/movimentar" method="post">
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
                                        <?php $counter1=-1;  if( isset($movimento) && ( is_array($movimento) || $movimento instanceof Traversable ) && sizeof($movimento) ) foreach( $movimento as $key1 => $value1 ){ $counter1++; ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars( $value1["tipo_movimento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                            <td><?php echo htmlspecialchars( $value1["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                            <td><?php echo htmlspecialchars( $value1["proc_data_entrada"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                            <td><?php echo htmlspecialchars( $value1["observacoes_proc_entrada"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
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
                                            <select class="custom-select custom-select-sm" name="id_tipo_movimento" id="id_tipo_movimento" required>
                                                <option value="" disabled selected>SELECIONE</option>
                                                <?php $counter1=-1;  if( isset($tipomovimento) && ( is_array($tipomovimento) || $tipomovimento instanceof Traversable ) && sizeof($tipomovimento) ) foreach( $tipomovimento as $key1 => $value1 ){ $counter1++; ?>
                                                <option value="<?php echo htmlspecialchars( $value1["id_tipo_movimento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["tipo_movimento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                                <?php } ?>
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
                                                    <input type="text" class="form-control form-control-sm" name="proc_data_entrada" id="proc_data_entrada">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-3">
                                            <div class="form-group row">
                                                <div class="col-sm-12 col-md-12">
                                                    <label class="col-form-label col-form-label-sm">Hora:</label>
                                                </div>
                                                <div class="col-sm-12 col-md-12">
                                                    <input type="time" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-5">
                                            <div class="form-group row">
                                                <div class="col-sm-12 col-md-12">
                                                    <label class="col-form-label col-form-label-sm ">SELECIONE ORGÃO:</label>
                                                </div>
                                                <div class="col-sm-12 col-md-12 text-black">
                                                    <select class="custom-select custom-select-sm" name="id_orgao" id="id_orgao" required>
                                                        <option value="" disabled selected>SELECIONE</option>
                                                        <?php $counter1=-1;  if( isset($orgao) && ( is_array($orgao) || $orgao instanceof Traversable ) && sizeof($orgao) ) foreach( $orgao as $key1 => $value1 ){ $counter1++; ?>
                                                        <option value="<?php echo htmlspecialchars( $value1["id_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                                        <?php } ?>
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
                                            <input type="text" class="form-control form-control-sm" name="observacoes_proc_entrada" id="observacoes_proc_entrada" required/>
                                            <!-- aqui eu vou passar o id_processo_documento -->
                                            <input type="hidden" id="id_processo_documento" name="id_processo_documento" value="id_processo_documento">
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
      