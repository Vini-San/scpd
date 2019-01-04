<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
            <section class="content-header">
            <h2>
                Consulta por Orgão
            </h2>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="/admin/users">Consultar Todos</a></li>
                <li class="active">Cadastrar</li>
            </ol>
            </section>
        
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-success">
                            <!-- form start -->
                            <form role="form" action="/admin/users/resultadopororgao" method="post">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-12 col-sm-10 col-md-5">
                                                Nova Consulta
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Orgão</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $counter1=-1;  if( isset($orgao) && ( is_array($orgao) || $orgao instanceof Traversable ) && sizeof($orgao) ) foreach( $orgao as $key1 => $value1 ){ $counter1++; ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars( $value1["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                                        <td><a href="/admin/users/<?php echo htmlspecialchars( $value1["id_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/resultadopororgao" class="btn btn-default btn-xs"><i class="fa fa-list-alt" aria-hidden="true"></i><b> Buscar</b></a></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-12 col-sm-10 col-md-6">
                                            Resultados para <?php echo htmlspecialchars( $user["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
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
                                                    <?php $counter1=-1;  if( isset($processo) && ( is_array($processo) || $processo instanceof Traversable ) && sizeof($processo) ) foreach( $processo as $key1 => $value1 ){ $counter1++; ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars( $value1["numero_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                                        <td><?php echo htmlspecialchars( $value1["assunto_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                                        <td><?php echo htmlspecialchars( $value1["data_inicio"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                                        <td><a href="/admin/users/situacao/<?php echo htmlspecialchars( $value1["id_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-default btn-xs"><i class="fa fa-list-alt" aria-hidden="true"></i><b> Consultar</b></a></td>
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