<?php if(!class_exists('Rain\Tpl')){exit;}?>    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h4>
        <b>SITUAÇÃO DO DOCUMENTO</b>
        </h4>
        <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li><a href="/admin/docs">Consultar Todos</a></li>
        <li><a href="/admin/docs/situacao/<?php echo htmlspecialchars( $docs["id_documento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">Situação do Documento</a></li>
        <li class="active">Movimentar Documento</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <form role="form" action="/admin/docs/movimentar/<?php echo htmlspecialchars( $docs["id_documento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/add" method="post">
                        <div class="box-body">
                            <div class="col-12 col-sm-10 col-md-6">
                                <div class="form-group row">
                                    <div class="col-10 col-sm-5 col-md-4">
                                        <label for="numero_documento" class="col-form-label col-form-label-sm">NÚMERO DO DOCUMENTO:</label>
                                    </div>
                                    <div class="col-10 col-sm-6 col-md-6">
                                        <label for="numero_documento" class="col-form-label col-form-label-sm"><?php echo htmlspecialchars( $docs["numero_documento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-10 col-sm-5 col-md-4">
                                        <label for="id_orgao" class="col-form-label col-form-label-sm">ORGÃO DE ORIGEM:</label>
                                    </div>
                                    <div class="col-10 col-sm-5 col-md-6">
                                        <label for="id_orgao" class="col-form-label col-form-label-sm"><?php echo htmlspecialchars( $docs["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>    
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-10 col-sm-5 col-md-4">
                                        <label for="id_tipo_documento" class="col-form-label col-form-label-sm">TIPO DOCUMENTO:</label>
                                    </div>
                                    <div class="col-10 col-sm-6 col-md-8">
                                        <label for="id_tipo_documento" class="col-form-label col-form-label-sm"><?php echo htmlspecialchars( $docs["tipo_documento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-0 col-sm-10 col-md-6">
                                <div class="form-group row">
                                    <div class="col-10 col-sm-5 col-md-3">
                                        <label for="data_inicio" class="col-form-label col-form-label-sm">DATA INICIO:</label>
                                    </div>
                                    <div class="col-8 col-sm-6 col-md-6">
                                        <label for="data_inicio" class="col-form-label col-form-label-sm"><?php echo formatDate($docs["data_inicio"]); ?></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-10 col-sm-8 col-md-3">
                                        <label for="nome_documento" class="col-form-label col-form-label-sm">NOME:</label>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-8">
                                        <label for="nome_documento" class="col-form-label col-form-label-sm"><?php echo htmlspecialchars( $docs["nome_documento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-10 col-sm-8 col-md-3">
                                        <label for="assunto_documento" class="col-form-label col-form-label-sm">ASSUNTO:</label>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-8">
                                        <label for="assunto_documento" class="col-form-label col-form-label-sm"><?php echo htmlspecialchars( $docs["assunto_documento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>
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
                                                <a href="/admin/docs/<?php echo htmlspecialchars( $value1["id_movimento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/editarmovimento/<?php echo htmlspecialchars( $docs["id_documento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table> 
                            </div>
                        </div>
                        
                        <div class="box-body">
                            <div class="box-body bg-primary">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-3">
                                        <div class="col-sm-12 col-md-12">
                                            <input type="hidden" class="form-control form-control-sm" id="id_documento" name="id_documento" value="<?php echo htmlspecialchars( $docs["id_documento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"/>
                                            <label class="col-form-label col-form-label-sm ">TIPO DE MOVIMENTO:</label>
                                        </div>
                                        <div class="col-sm-12 col-md-12 text-black">
                                            <select class="btn btn-md" id="id_tipo_movimento" name="id_tipo_movimento" required>
                                                <option value="" disabled selected>SELECIONE</option>
                                                <?php $counter1=-1;  if( isset($tipomovimento) && ( is_array($tipomovimento) || $tipomovimento instanceof Traversable ) && sizeof($tipomovimento) ) foreach( $tipomovimento as $key1 => $value1 ){ $counter1++; ?>
                                                <option value="<?php echo htmlspecialchars( $value1["id_tipo_movimento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["tipo_movimento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-3">
                                        <div class="form-group row">
                                            <div class="col-sm-12 col-md-10">
                                                <label class="col-form-label col-form-label-sm">Data:</label>
                                            </div>
                                            <div class="col-sm-12 col-md-10">
                                                <input type="date" class="form-control form-control-sm" id="proc_data_entrada" name="proc_data_entrada" placeholder="aaaa-mm-dd">
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6">
                                        <div class="form-group row">
                                            <div class="col-sm-12 col-md-12">
                                                <label class="col-form-label col-form-label-sm">Origem:</label>
                                            </div>
                                            <div class="col-sm-12 col-md-12 text-black">
                                                <select class="btn btn-md" id="id_orgao_movimento" name="id_orgao_movimento">
                                                    <option value="#">SELECIONE</option>
                                                    <?php $counter1=-1;  if( isset($orgao) && ( is_array($orgao) || $orgao instanceof Traversable ) && sizeof($orgao) ) foreach( $orgao as $key1 => $value1 ){ $counter1++; ?>
                                                    <option value="<?php echo htmlspecialchars( $value1["id_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                                    <?php } ?>
                                                </select>
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
                                            <input type="text" class="form-control form-control-sm" id="observacoes" name="observacoes" required/>
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
      