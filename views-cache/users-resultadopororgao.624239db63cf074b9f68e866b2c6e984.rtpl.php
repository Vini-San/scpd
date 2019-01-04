<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
        <h2>
            Resultado Por Orgão
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
                                <div class="col-12 col-sm-10 col-md-12">
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
                            </div>
                            <div class="box-body">
                                <div class="col-12 col-sm-10 col-md-12">
                                    <h2><?php echo htmlspecialchars( $user["id_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h2>
                                    <table class="table table-striped">
                                    <thead>
                                            <tr>
                                                <th>numero</th>
                                                <th>ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $counter1=-1;  if( isset($processo) && ( is_array($processo) || $processo instanceof Traversable ) && sizeof($processo) ) foreach( $processo as $key1 => $value1 ){ $counter1++; ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars( $value1["numero_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                                <td><a href="/admin/users/<?php echo htmlspecialchars( $value1["id_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/resultadopororgao" class="btn btn-default btn-xs"><i class="fa fa-list-alt" aria-hidden="true"></i><b> Buscar</b></a></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table> 
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