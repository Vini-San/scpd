<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h4>
    <b>Lista de Processos</b>
  </h4>
  <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/processos">Consultar Todos</a></li>
        <li><a href="javascript:window.history.go(-1)">Voltar Anterior</a></li>
        <li class="active">Editar</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Editar Processo</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/docs/<?php echo htmlspecialchars( $docs["id_documento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="numero_documento">Numero</label>
              <input type="text" class="form-control" id="numero_documento" name="numero_processo" placeholder="Digite o numero" value="<?php echo htmlspecialchars( $docs["numero_documento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="id_orgao">Orgão</label>
              <select id="id_orgao" name="id_orgao">
                <option value="<?php echo htmlspecialchars( $docs["id_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled selected><?php echo htmlspecialchars( $docs["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                <?php $counter1=-1;  if( isset($orgao) && ( is_array($orgao) || $orgao instanceof Traversable ) && sizeof($orgao) ) foreach( $orgao as $key1 => $value1 ){ $counter1++; ?>
                <option value="<?php echo htmlspecialchars( $value1["id_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="id_tipo_documento">Tipo</label>
              <select id="id_tipo_documento" name="id_tipo_documento">
                <option value="<?php echo htmlspecialchars( $docs["id_tipo_documento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled selected><?php echo htmlspecialchars( $docs["tipo_documento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                <?php $counter1=-1;  if( isset($tipo) && ( is_array($tipo) || $tipo instanceof Traversable ) && sizeof($tipo) ) foreach( $tipo as $key1 => $value1 ){ $counter1++; ?>
                <option value="<?php echo htmlspecialchars( $value1["id_tipo_documento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["tipo_documento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="data_inicio">Data Inicio</label>
              <input type="text" class="form-control" id="data_inicio" name="data_inicio" placeholder="Digite a data"  value="<?php echo formatDate($docs["data_inicio"]); ?>">
            </div>
            <div class="form-group">
              <label for="nome_documento">Nome</label>
              <input type="text" class="form-control" id="nome_documento" name="nome_documento" placeholder="Digite o nome" value="<?php echo htmlspecialchars( $docs["nome_documento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="assunto_documento">Assunto</label>
              <input type="text" class="form-control" id="assunto_documento" name="assunto_documento" placeholder="Digite o assunto" value="<?php echo htmlspecialchars( $docs["assunto_documento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->