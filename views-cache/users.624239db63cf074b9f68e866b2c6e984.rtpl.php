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
              <form role="form" action="/admin/users/create" method="post">
                <label for="numero_processo" style="width: 120px">Buscar por órgão </label>
                <input type="text" id="nome_usuario" name="nome_usuario" placeholder="Informe o órgão" >
                <button type="submit" class="btn btn-primary btn-sm"> Buscar</button>
              </form>
            </div>

            <div class="box-body no-padding">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th></th>
                    <th style="width: 250px">Nome</th>
                    <th>Login</th>
                    <th>Órgão</th>
                    <th>Nível</th>
                    <th>Situação</th>
                    <th style="width: 150px"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                  <?php $counter1=-1;  if( isset($users) && ( is_array($users) || $users instanceof Traversable ) && sizeof($users) ) foreach( $users as $key1 => $value1 ){ $counter1++; ?>
                  <tr>
                    <td></td>
                    <td><?php echo htmlspecialchars( $value1["nome_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["cpf"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["nivel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td/>
                    <td><?php echo htmlspecialchars( $value1["situacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td/>
                    <td>
                      <a href="/admin/users/<?php echo htmlspecialchars( $value1["id_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a>
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