<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
    <h4>
        <b>Cadastro de Documento / Novo Documento</b>
    </h4>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/docs">Consultar Todos</a></li>
        <li class="active">Cadastrar</li>
    </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <!-- form start -->
                    <form role="form" action="/admin/docs/create" method="post">
                        <div class="box-body">
                            <div class="col-12 col-sm-10 col-md-6">
                                <div class="form-group row">
                                    <div class="col-10 col-sm-5 col-md-8">
                                        <label for="numero_documento" class="col-form-label col-form-label-sm">NÚMERO DO DOCUMENTO:</label>
                                        <input type="text" class="form-control form-control-sm" id="numero_documento" name="numero_documento" placeholder="Informe o numero do documento" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-10 col-sm-5 col-md-8">
                                        <label for="id_orgao" class="col-form-label col-form-label-sm">ORGÃO DE ORIGEM:</label>
                                        <select class="btn btn-md btn-default" id="id_orgao" name="id_orgao">
                                            <option value="#">SELECIONE</option>
                                            <?php $counter1=-1;  if( isset($orgao) && ( is_array($orgao) || $orgao instanceof Traversable ) && sizeof($orgao) ) foreach( $orgao as $key1 => $value1 ){ $counter1++; ?>
                                            <option  value="<?php echo htmlspecialchars( $value1["id_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                            <?php } ?>
                                        </select> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-10 col-sm-5 col-md-4">
                                        <label for="id_tipo_documento" class="col-form-label col-form-label-sm">TIPO DE DOCUMENTO:</label>
                                        <select class="btn btn-md btn-default" id="id_tipo_documento" name="id_tipo_documento">
                                            <option value="#">SELECIONE</option>
                                            <?php $counter1=-1;  if( isset($tipo) && ( is_array($tipo) || $tipo instanceof Traversable ) && sizeof($tipo) ) foreach( $tipo as $key1 => $value1 ){ $counter1++; ?>
                                            <option value="<?php echo htmlspecialchars( $value1["id_tipo_documento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["tipo_documento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-0 col-sm-10 col-md-6">
                                <div class="form-group row">
                                    <div class="col-10 col-sm-5 col-md-8">
                                        <label for="data_inicio" class="col-form-label col-form-label-sm">DATA INICIO:</label>
                                        <input type="date" class="form-control form-control-sm" id="data_inicio" name="data_inicio">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-10 col-sm-8 col-md-8">
                                        <label for="nome_documento" class="col-form-label col-form-label-sm">NOME:</label>
                                        <input type="text" class="form-control form-control-sm" id="nome_documento" name="nome_documento" placeholder="Informe o nome" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-10 col-sm-8 col-md-8">
                                        <label for="assunto_documento" class="col-form-label col-form-label-sm">ASSUNTO:</label>
                                        <input type="text" class="form-control form-control-sm" id="assunto_documento" name="assunto_documento" placeholder="Informe o assunto" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="box-body">
                            <div class="box-body bg-primary">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>ENTRADA</h4>
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-3">
                                                <div class="form-group row">
                                                    <div class="col-sm-12 col-md-12">
                                                        <label class="col-form-label col-form-label-sm">Data:</label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-12">
                                                        <input type="date" class="form-control form-control-sm" id="proc_data_entrada" name="proc_data_entrada">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-2">
                                                <div class="form-group row">
                                                    <div class="col-sm-12 col-md-12">
                                                        <label class="col-form-label col-form-label-sm">Origem:</label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-12 text-black">
                                                        <select class="btn btn-md" id="id_orgao_movimento" name="id_orgao_movimento">
                                                            <option class="pl-3 pr-3" value="#">SELECIONE</option>
                                                            <?php $counter1=-1;  if( isset($orgao) && ( is_array($orgao) || $orgao instanceof Traversable ) && sizeof($orgao) ) foreach( $orgao as $key1 => $value1 ){ $counter1++; ?>
                                                            <option value="<?php echo htmlspecialchars( $value1["id_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12">
                                        <div class="form-group row">
                                            <div class="col-sm-10 col-md-10">
                                                <label class="col-form-label col-form-label-sm">Observações:</label>
                                            </div>
                                            <div class="col-sm-12 col-md-10">
                                                <input type="text" class="form-control form-control-sm" id="observacoes" name="observacoes" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box">
                                <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                                <button type="button" class="btn btn-primary btn-sm">Cancelar</button>
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