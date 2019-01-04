<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
        <h2>
            Consultar por Órgão
        </h2>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Consultar por Órgão</li>
        </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                    <!-- form start -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-12 col-sm-10 col-md-5">
                                        Nova Consulta
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th><b>Orgão</b></th>
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->