<?php if(!class_exists('Rain\Tpl')){exit;}?><body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SCPD</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img width="90" class="ml-2" src="/res/admin/dist/img/FAETEC(3).png"></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-sitemap" aria-hidden="true"></i>
              <span class="label label-warning">+</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Cadastros Administrativos</li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">
                  <li><!-- start notification -->
                    <a href="#">
                      <i class="fa fa-building" aria-hidden="true"></i> Cadastrar Novo Orgão
                    </a>
                  </li>
                  <!-- end notification -->
                </ul>
              </li>
              <li class="footer"><a href="/admin/orgaos">Todos os Órgãos</a></li>
            </ul>
          </li>
          <!-- Tasks Menu -->
          <li class="dropdown tasks-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-user-plus" aria-hidden="true"></i>
              <span class="label label-danger">+</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Usuários</li>
              <li>
                <!-- Inner menu: contains the tasks -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="/admin/users/create">
                      <!-- Task title and progress text -->
                      <h3>
                        Cadastrar Novo Usuário
                        <small class="pull-right"><i class="fa fa-user" aria-hidden="true"></i></small>
                      </h3>
                      <!-- The progress bar -->
                      <!--<div class="progress xs">
                        Change the css width attribute to simulate progress
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>-->
                    </a>
                  </li>
                  <li><!-- Task item -->
                    <a href="#">
                      <!-- Task title and progress text -->
                      <h3>
                        <?php $counter1=-1;  if( isset($user) && ( is_array($user) || $user instanceof Traversable ) && sizeof($user) ) foreach( $user as $key1 => $value1 ){ $counter1++; ?>
                        Editar <?php echo htmlspecialchars( $value1["nome_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                        <?php } ?>
                        <small class="pull-right"><i class="fa fa-user" aria-hidden="true"></i></small>
                      </h3>
                      <!-- The progress bar -->
                      <!--<div class="progress xs">
                        Change the css width attribute to simulate progress
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>-->
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="/admin/users">Ver todos os Usuários</a>
              </li>
            </ul>
          </li>
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <?php $counter1=-1;  if( isset($user) && ( is_array($user) || $user instanceof Traversable ) && sizeof($user) ) foreach( $user as $key1 => $value1 ){ $counter1++; ?>
              <img src="/res/admin/dist/img/<?php echo htmlspecialchars( $value1["nome_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>.png" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo htmlspecialchars( $value1["nome_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                
                <img src="/res/admin/dist/img/<?php echo htmlspecialchars( $value1["nome_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>.png" class="img-circle" alt="User Image">

                <p>
                  <?php echo htmlspecialchars( $value1["nome_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                  <small><?php echo htmlspecialchars( $value1["nivel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></small>
                  <?php } ?>
                </p>
              </li>
              <!-- Menu Body -->
              <!--<li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
              </li>-->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat"><b>Perfil</b></a>
                </div>
                <div class="pull-right">
                  <a href="/admin/login" class="btn btn-default btn-flat">Sair</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <?php $counter1=-1;  if( isset($user) && ( is_array($user) || $user instanceof Traversable ) && sizeof($user) ) foreach( $user as $key1 => $value1 ){ $counter1++; ?>
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/res/admin/dist/img/<?php echo htmlspecialchars( $value1["nome_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo htmlspecialchars( $value1["nome_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>

          <?php } ?>
        </div>
      </div>

      <!-- search form (Optional)
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="treeview">
          <a href="#"><i class="fa fa-book fa-fw"></i> <span>Processos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="/admin/processos/create"><i class="fa fa-floppy-o" aria-hidden="true"></i><span>Cadastrar</span></a></li>
            <!--<li ><a href="/admin/users"><i class="fa fa-search" aria-hidden="true"></i><span>Relatório semanal</span></a></li>-->
            <li ><a href="/admin/processos"><i class="fa fa-pencil" aria-hidden="true"></i><span>Consultar Todos</span></a></li>
            <li ><a href="/admin/processos/pororgao"><i class="fa fa-search" aria-hidden="true"></i><span>Consultar por órgao</span></a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-file-text-o"></i> <span>Documentos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="/admin/docs/create"><i class="fa fa-floppy-o" aria-hidden="true"></i><span>Cadastro</span></a></li>
            <li ><a href="/admin/docs"><i class="fa fa-search" aria-hidden="true"></i><span>Consulta Todos</span></a></li>
            <li ><a href="/admin/docs/pororgao"><i class="fa fa-pencil" aria-hidden="true"></i><span>Consultar por órgao</span></a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h4>
            <b>EDITAR MOVIMENTO</b>
        </h4>
        <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li><a href="/admin/processos">Consultar Todos</a></li>
        <li><a href="/admin/processos/situacao/<?php echo htmlspecialchars( $processo["id_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">Situação do Processo</a></li>
        <li><a href="javascript:window.history.go(-1)">Voltar Anterior</a></li>
        <li class="active">Editar Movimento</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <form role="form" action="/admin/processos/editarmovimento/<?php echo htmlspecialchars( $processo["id_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/update" method="post">
                        <div class="box-body">
                            <div class="col-12 col-sm-10 col-md-6">
                                <div class="form-group row">
                                    <div class="col-10 col-sm-5 col-md-4">
                                        <label for="numero_processo" class="col-form-label col-form-label-sm">NÚMERO DO PROCESSO:</label>
                                    </div>
                                    <div class="col-10 col-sm-6 col-md-6">
                                        <label for="numero_processo" class="col-form-label col-form-label-sm"><?php echo htmlspecialchars( $processo["numero_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-10 col-sm-5 col-md-4">
                                        <label for="id_orgao" class="col-form-label col-form-label-sm">ORGÃO DE ORIGEM:</label>
                                    </div>
                                    <div class="col-10 col-sm-5 col-md-6">
                                        <label for="numero_processo" class="col-form-label col-form-label-sm"><?php echo htmlspecialchars( $processo["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>    
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-10 col-sm-5 col-md-4">
                                        <label for="id_tipo_processo" class="col-form-label col-form-label-sm">TIPO DOCUMENTO:</label>
                                    </div>
                                    <div class="col-10 col-sm-6 col-md-8">
                                        <label for="numero_processo" class="col-form-label col-form-label-sm"><?php echo htmlspecialchars( $processo["tipo_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-0 col-sm-10 col-md-6">
                                <div class="form-group row">
                                    <div class="col-10 col-sm-5 col-md-3">
                                        <label for="data_inicio" class="col-form-label col-form-label-sm">DATA INICIO:</label>
                                    </div>
                                    <div class="col-8 col-sm-6 col-md-6">
                                        <label for="data_inicio" class="col-form-label col-form-label-sm"><?php echo formatDate($processo["data_inicio"]); ?></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-10 col-sm-8 col-md-3">
                                        <label for="nome_processo" class="col-form-label col-form-label-sm">NOME:</label>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-8">
                                        <label for="data_inicio" class="col-form-label col-form-label-sm"><?php echo htmlspecialchars( $processo["nome_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-10 col-sm-8 col-md-3">
                                        <label for="assunto_processo" class="col-form-label col-form-label-sm">ASSUNTO:</label>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-8">
                                        <label for="assunto_processo" class="col-form-label col-form-label-sm"><?php echo htmlspecialchars( $processo["assunto_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="box-body bg-primary">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-3">
                                        <div class="col-sm-12 col-md-12">
                                            <input type="hidden" class="form-control form-control-sm" id="id_processo" name="id_processo" value="<?php echo htmlspecialchars( $processo["id_processo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"/>
                                            <input type="hidden" class="form-control form-control-sm" id="id_movimento" name="id_movimento" value="<?php echo htmlspecialchars( $movimento["id_movimento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"/>
                                            <label class="col-form-label col-form-label-sm ">TIPO DE MOVIMENTO:</label>
                                        </div>
                                        <div class="col-sm-12 col-md-12 text-black">
                                            <select class="btn btn-md" id="id_tipo_movimento" name="id_tipo_movimento" required>
                                                <option value="" disabled selected><?php echo htmlspecialchars( $movimento["tipo_movimento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                                <?php $counter1=-1;  if( isset($tipomovimento) && ( is_array($tipomovimento) || $tipomovimento instanceof Traversable ) && sizeof($tipomovimento) ) foreach( $tipomovimento as $key1 => $value1 ){ $counter1++; ?>
                                                <option value="<?php echo htmlspecialchars( $value1["id_tipo_movimento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["tipo_movimento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6">
                                        <div class="form-group row">
                                            <div class="col-sm-12 col-md-12">
                                                <label class="col-form-label col-form-label-sm">Origem:</label>
                                            </div>
                                            <div class="col-sm-12 col-md-12 text-black">
                                                <select class="btn btn-sm" id="id_orgao" name="id_orgao">
                                                    <option value="#" disabled selected><?php echo htmlspecialchars( $movimento["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                                    <?php $counter1=-1;  if( isset($orgao) && ( is_array($orgao) || $orgao instanceof Traversable ) && sizeof($orgao) ) foreach( $orgao as $key1 => $value1 ){ $counter1++; ?>
                                                    <option value="<?php echo htmlspecialchars( $value1["id_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nome_orgao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-3">
                                        <div class="form-group row">
                                            <div class="col-sm-12 col-md-10">
                                                <label class="col-form-label col-form-label-sm">Data:</label>
                                            </div>
                                            <div class="col-sm-12 col-md-10">
                                                <input type="text" class="form-control form-control-sm" id="proc_data_entrada" name="proc_data_entrada" value="<?php echo formatDate($movimento["proc_data_entrada"]); ?>" placeholder="dd/mm/yyyy">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-10">
                                    <div class="form-group row">
                                        <div class="col-sm-10 col-md-12">
                                            <label class="col-form-label col-form-label-sm">Observações:</label>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <input type="text" class="form-control form-control-sm" id="observacoes_proc_entrada" name="observacoes_proc_entrada" value="<?php echo htmlspecialchars( $movimento["observacoes_proc_entrada"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                            <input type="reset" class="btn btn-primary btn-sm"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Your Page Content Here -->
    </section>
        <!-- /.content -->
</div>
      <!-- /.content-wrapper -->
