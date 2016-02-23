<div id="header">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="<?php if($sec == 'usuarios') echo 'active' ?>"><a href="users.php">Usuarios</a></li>
            <li class="<?php if($sec == 'new-user') echo 'active' ?>"><a href="new_user.php">Nuevo usuario</a></li>
            <?php if($_SESSION['username']){
                $name = $_SESSION['username'];?>
                <li class="<?php if($sec == 'user') echo 'active' ?>"><a href="../account.php"><?php echo $name?></a></li>
                <li><a href="../back/user-auth.php?actionMethod=logout">Cerrar Sesión</a></li>
              <?php
            } else {?>
            <li class="<?php if($sec == 'login') echo 'active' ?>"><a href="../login.php">Iniciar Sesión</a></li>
            <?php } ?>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
</div>

