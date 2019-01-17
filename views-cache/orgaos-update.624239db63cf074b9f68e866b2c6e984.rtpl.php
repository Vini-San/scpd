<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
    <h4>
        <b>Cadastro de Órgão</b>
    </h4>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/orgaos">Consultar Todos Órgãos</a></li>
        <li class="active">Cadastrar Órgão</li>
    </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <!-- form start -->
                    <form role="form" action="/admin/orgaos/<?php echo htmlspecialchars( $users["id_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
                        <div class="box-body">
                            <div class="col-12 col-sm-10 col-md-6">
                                <div class="form-group row">
                                    <div class="col-10 col-sm-5 col-md-8">
                                        <label for="nome_orgao" class="col-form-label col-form-label-sm">ÓRGÃO</label>
                                        <input type="text" class="form-control form-control-sm" id="nome_orgao" name="nome_orgao" value="<?php echo htmlspecialchars( $users["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-2">
                                        <div class="col-sm-12 col-md-12">
                                            <label class="col-form-label col-form-label-sm">HIERARQUIA</label>
                                        </div>
                                        <div class="col-sm-12 col-md-12 text-black">
                                            <select class="btn btn-md btn-default" id="id_hierarquia_orgao" name="id_hierarquia_orgao" required>
                                                <option class="pl-3 pr-3" value="<?php echo htmlspecialchars( $users["id_hierarquia_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled selected><?php echo htmlspecialchars( $users["tipo_hierarquia"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                                <?php $counter1=-1;  if( isset($hierarquia) && ( is_array($hierarquia) || $hierarquia instanceof Traversable ) && sizeof($hierarquia) ) foreach( $hierarquia as $key1 => $value1 ){ $counter1++; ?>
                                                <option value="<?php echo htmlspecialchars( $value1["id_hierarquia_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["tipo_hierarquia"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-10 col-sm-5 col-md-8">
                                        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                                        <button type="button" class="btn btn-primary btn-sm">Cancelar</button>
                                    </div>
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