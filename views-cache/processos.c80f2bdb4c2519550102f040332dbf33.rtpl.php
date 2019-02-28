<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h4>
    <b>Lista de Processos</b>
  </h4>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="javascript:window.history.go(-1)">Voltar Anterior</a></li>
    <li class="active">Consultar Todos</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">
            
            <div class="box-header">
              <a href="/admin/processos/create" class="btn btn-success">Cadastrar Processo</a>
            </div>
            <div class="box-body">
              <div class="form-group row">
                <form action="/admin/processos">
                  <div class="col-10 col-sm-5 col-md-4">
                    <input type="text" name="search" class="form-control pull-right" placeholder="Procurar Processos" value="<?php echo htmlspecialchars( $search, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
                  <div class="col-10 col-sm-6 col-md-6">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </form>
              </div>
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
                  <?php $counter1=-1;  if( isset($processos) && ( is_array($processos) || $processos instanceof Traversable ) && sizeof($processos) ) foreach( $processos as $key1 => $value1 ){ $counter1++; ?>
                  <tr>
                    <td><?php echo htmlspecialchars( $value1["numero_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["assunto_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo formatDate($value1["data_inicio"]); ?></td/>
                    <td>
                      <a href="/admin/processos/<?php echo htmlspecialchars( $value1["id_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a>
                      <a href="/admin/processos/situacao/<?php echo htmlspecialchars( $value1["id_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-default btn-xs"><i class="fa fa-list-alt" aria-hidden="true"></i><b> Consultar</b></a>
                      <a href="/admin/processos/movimentar/<?php echo htmlspecialchars( $value1["id_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-success btn-xs"><i class="fa fa-plus-circle" aria-hidden="true"></i> Movimentar</a>
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