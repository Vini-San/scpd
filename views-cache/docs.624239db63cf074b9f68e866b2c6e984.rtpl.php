<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h4>
    <b>Lista de Documentos</b>
  </h4>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Consultar Todos</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">
            
            <div class="box-header">
              <a href="/admin/docs/create" class="btn btn-success">Cadastrar Documento</a>
            </div>

            <div class="box-body no-padding">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="width: 10px">Numero</th>
                    <th>Assunto</th>
                    <th>Órgão</th>
                    <th>Data Início</th>
                    <th style="width: 250px"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                  <?php $counter1=-1;  if( isset($docs) && ( is_array($docs) || $docs instanceof Traversable ) && sizeof($docs) ) foreach( $docs as $key1 => $value1 ){ $counter1++; ?>
                  <tr>
                    <td><?php echo htmlspecialchars( $value1["numero_documento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["assunto_documento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo formatDate($value1["data_inicio"]); ?></td/>
                    <td>
                      <a href="/admin/docs/<?php echo htmlspecialchars( $value1["id_documento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a>
                      <a href="/admin/docs/situacao/<?php echo htmlspecialchars( $value1["id_documento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-default btn-xs"><i class="fa fa-list-alt" aria-hidden="true"></i><b> Consultar</b></a>
                      <!--<a href="/admin/docs/movimentar/<?php echo htmlspecialchars( $value1["id_documento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-success btn-xs"><i class="fa fa-plus-circle" aria-hidden="true"></i> Movimentar</a>-->
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->