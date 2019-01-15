<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
            <section class="content-header">
            <h4>
                <b>Consultar por Orgão</b>
            </h4>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="/admin/processos">Consultar Todos</a></li>
                <li><a href="javascript:window.history.go(-1)">Voltar</a></li>
                <li class="active">Processos por Órgão de <?php echo htmlspecialchars( $processo["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?> </li>
            </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-success">
                            <!-- form start -->
                            <form role="form" action="/admin/processos/resultadopororgao" method="post">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-12 col-sm-10 col-md-5">
                                            Nova Consulta
                                            <div class="dropdown scroll">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    Orgão
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                    <?php $counter1=-1;  if( isset($orgao) && ( is_array($orgao) || $orgao instanceof Traversable ) && sizeof($orgao) ) foreach( $orgao as $key1 => $value1 ){ $counter1++; ?>  
                                                    <li><a href="/admin/processos/<?php echo htmlspecialchars( $value1["id_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/resultadopororgao"><?php echo htmlspecialchars( $value1["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-10 col-md-6">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Numero</th>
                                                        <th>Assunto</th>
                                                        <th>Data Início</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $counter1=-1;  if( isset($resultadoprocesso) && ( is_array($resultadoprocesso) || $resultadoprocesso instanceof Traversable ) && sizeof($resultadoprocesso) ) foreach( $resultadoprocesso as $key1 => $value1 ){ $counter1++; ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars( $value1["numero_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                                        <td><?php echo htmlspecialchars( $value1["assunto_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                                        <td><?php echo formatDate($value1["data_inicio"]); ?></td>
                                                        <td><a href="/admin/processos/situacao/<?php echo htmlspecialchars( $value1["id_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-default btn-xs"><i class="fa fa-list-alt" aria-hidden="true"></i><b> Consultar</b></a></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table> 
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