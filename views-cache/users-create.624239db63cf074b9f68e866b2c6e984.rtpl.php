<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Cadastro do Processo
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/admin/users">Processos</a></li>
    <li class="active"><a href="/admin/users/create">Cadastrar</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Novo Processo</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/users/create" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="numero_processo">Numero do Processo</label>
              <input type="text" class="form-control" id="numero_processo" name="numero_processo" placeholder="Digite o numero do processo">
            </div>
            <div class="form-group">
              <label for="id_orgao">Orgão</label>
              <select id="id_orgao" name="id_orgao">
                <option value="#">Selecione o órgão</option>
                <?php $counter1=-1;  if( isset($user) && ( is_array($user) || $user instanceof Traversable ) && sizeof($user) ) foreach( $user as $key1 => $value1 ){ $counter1++; ?>
                <option value="<?php echo htmlspecialchars( $value1["id_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="id_tipo_processo">Tipo</label>
              <select id="id_tipo_processo" name="id_tipo_processo">
                <option value="#">Selecione o Tipo</option>
                <?php $counter1=-1;  if( isset($user) && ( is_array($user) || $user instanceof Traversable ) && sizeof($user) ) foreach( $user as $key1 => $value1 ){ $counter1++; ?>
                <option value="<?php echo htmlspecialchars( $value1["id_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["id_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="data_inicio">Data de Inicio</label>
              <input type="date" class="form-control" id="data_inicio" name="data_inicio" placeholder="Digite a data de início">
            </div>
            <div class="form-group">
              <label for="nome_processo">Nome</label>
              <input type="text" class="form-control" id="nome_processo" name="nome_processo" placeholder="Digite o nome">
            </div>
            <div class="form-group">
              <label for="assunto_processo">Assunto</label>
              <input type="text" class="form-control" id="assunto_processo" name="assunto_processo" placeholder="Digite o assunto">
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-success">Cadastrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->