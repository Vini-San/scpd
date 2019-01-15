<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h4>
    <b>Lista de Usuários</b>
  </h4>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Consultar Todos Usuários</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">
            
            <div class="box-header">
              <div class="dropdown scroll">
                <label for="numero_processo" style="width: 120px"> Buscar órgão </label>
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> Selecione <span class="caret"></span></button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                  <?php $counter1=-1;  if( isset($orgaos) && ( is_array($orgaos) || $orgaos instanceof Traversable ) && sizeof($orgaos) ) foreach( $orgaos as $key1 => $value1 ){ $counter1++; ?>
                  <li><a href="/admin/users/<?php echo htmlspecialchars( $value1["id_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/resultadopororgao"><?php echo htmlspecialchars( $value1["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
                  <?php } ?>
                </ul>
              </div>
            </div>

            <div class="box-body no-padding">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th></th>
                    <th>Órgão</th>
                    <th style="width: 200px"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                  <?php $counter1=-1;  if( isset($orgaos) && ( is_array($orgaos) || $orgaos instanceof Traversable ) && sizeof($orgaos) ) foreach( $orgaos as $key1 => $value1 ){ $counter1++; ?>
                  <tr>
                    <td></td>
                    <td><?php echo htmlspecialchars( $value1["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td>
                      <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a>
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