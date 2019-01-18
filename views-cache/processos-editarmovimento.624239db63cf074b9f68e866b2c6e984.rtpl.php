<?php if(!class_exists('Rain\Tpl')){exit;}?>    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h4>
            <b>EDITAR MOVIMENTO</b>
        </h4>
        <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li><a href="/admin/processos">Consultar Todos</a></li>
        <li><a href="/admin/processos/situacao/<?php echo htmlspecialchars( $processo["id_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">Situação do Processo</a></li>
        <li><a href="javascript:window.history.go(-1)">Voltar Anterior</a></li>
        <li class="active">Editar Movimento</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <form role="form" action="/admin/processos/editarmovimento/<?php echo htmlspecialchars( $processo["id_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/update" method="post">
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
                        <div class="box-body">
                            <div class="box-body bg-primary">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-3">
                                        <div class="col-sm-12 col-md-12">
                                            <input type="hidden" class="form-control form-control-sm" id="id_processo" name="id_processo" value="<?php echo htmlspecialchars( $processo["id_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"/>
                                            <input type="hidden" class="form-control form-control-sm" id="id_movimento" name="id_movimento" value="<?php echo htmlspecialchars( $movimento["id_movimento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"/>
                                            <label class="col-form-label col-form-label-sm ">TIPO DE MOVIMENTO:</label>
                                        </div>
                                        <div class="col-sm-12 col-md-12 text-black">
                                            <select class="btn btn-md" id="id_tipo_movimento" name="id_tipo_movimento" required>
                                                <option value="" disabled selected><?php echo htmlspecialchars( $movimento["tipo_movimento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                                <?php $counter1=-1;  if( isset($tipomovimento) && ( is_array($tipomovimento) || $tipomovimento instanceof Traversable ) && sizeof($tipomovimento) ) foreach( $tipomovimento as $key1 => $value1 ){ $counter1++; ?>
                                                <option value="<?php echo htmlspecialchars( $value1["id_tipo_movimento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["tipo_movimento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6">
                                        <div class="form-group row">
                                            <div class="col-sm-12 col-md-12">
                                                <label class="col-form-label col-form-label-sm">Origem:</label>
                                            </div>
                                            <div class="col-sm-12 col-md-12 text-black">
                                                <select class="btn btn-sm" id="id_orgao" name="id_orgao">
                                                    <option value="#" disabled selected><?php echo htmlspecialchars( $movimento["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                                    <?php $counter1=-1;  if( isset($orgao) && ( is_array($orgao) || $orgao instanceof Traversable ) && sizeof($orgao) ) foreach( $orgao as $key1 => $value1 ){ $counter1++; ?>
                                                    <option value="<?php echo htmlspecialchars( $value1["id_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-3">
                                        <div class="form-group row">
                                            <div class="col-sm-12 col-md-10">
                                                <label class="col-form-label col-form-label-sm">Data:</label>
                                            </div>
                                            <div class="col-sm-12 col-md-10">
                                                <input type="text" class="form-control form-control-sm" id="proc_data_entrada" name="proc_data_entrada" value="<?php echo formatDate($movimento["proc_data_entrada"]); ?>" placeholder="dd/mm/yyyy">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-10">
                                    <div class="form-group row">
                                        <div class="col-sm-10 col-md-12">
                                            <label class="col-form-label col-form-label-sm">Observações:</label>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <input type="text" class="form-control form-control-sm" id="observacoes_proc_entrada" name="observacoes_proc_entrada" value="<?php echo htmlspecialchars( $movimento["observacoes_proc_entrada"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                            <input type="reset" class="btn btn-primary btn-sm"/>
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
