<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lista de Processos
  </h1>
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
        <form role="form" action="/admin/users/<?php echo htmlspecialchars( $user["id_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="numero_processo">Numero</label>
              <input type="text" class="form-control" id="numero_processo" name="numero_processo" placeholder="Digite o numero" value="<?php echo htmlspecialchars( $user["numero_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="id_orgao">Orgão</label>
              <select id="id_orgao" name="id_orgao">
                <option value="<?php echo htmlspecialchars( $user["id_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $user["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                <option value="1">DGI</option>
                <option value="2">UERJ</option>
              </select>
            </div>
            <div class="form-group">
              <label for="id_tipo_processo">Tipo</label>
              <select id="id_tipo_processo" name="id_tipo_processo">
                <option value="<?php echo htmlspecialchars( $user["id_tipo_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $user["tipo_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                <option value="1">ACI</option>
                <option value="2">Furto</option>
                <option value="3">Processo Administrativo</option>
              </select>
            </div>
            <div class="form-group">
              <label for="data_inicio">Data Inicio</label>
              <input type="text" class="form-control" id="data_inicio" name="data_inicio" placeholder="Digite a data"  value="<?php echo htmlspecialchars( $user["data_inicio"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="nome_processo">Nome</label>
              <input type="text" class="form-control" id="nome_processo" name="nome_processo" placeholder="Digite o nome" value="<?php echo htmlspecialchars( $user["nome_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="assunto_processo">Assunto</label>
              <input type="text" class="form-control" id="assunto_processo" name="assunto_processo" placeholder="Digite o assunto" value="<?php echo htmlspecialchars( $user["assunto_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
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