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