<?php 
  include "controllers/UserController.php";
  $userController = new UserController();

  $users = $userController->get(); 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>

        </title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        
    </head>

    <body>
        <div class="container-fluid">

            <nav class="navbar navbar-expand-lg navbar navbar-dark bg-primary ">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                  <a class="navbar-brand" href="#">
                    <img src="tunko.jpg" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">  
                    Jona's Inc.</a>
                  <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                      <a class="nav-link" href="#">Inicio<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Links</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Desactivado</a>
                    </li>
                  </ul>
                  <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                  </form>
                </div>
              </nav>

              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">Home</li>
                </ol>
              </nav>

             

              <div class="jumbotron">
                <h1 class="display-4">Hello, world!</h1>
                <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                <hr class="my-4">
                <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
              </div>
        </div>


        <?php if (isset($_SESSION['status']) && $_SESSION['status'] == 'sucess' ): ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Correcto</strong><?= $_SESSION['message'] ?>.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php unset($_SESSION['status']); ?>
        <?php endif ?>

        <?php if (isset($_SESSION['status']) && $_SESSION['status'] == 'error' ): ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Error</strong><?= $_SESSION['message'] ?>.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php unset($_SESSION['status']); ?>
        <?php endif ?> 

        <div class="row mt-5 ">
          
          <div class="col"> 
          
            <div class="card">
              <div class="card-header">
                
                Tabla de usuarios registrados

                <button onclick="add()" type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                  Añadir usuario
                </button>

              </div>
              <div class="card-body"> 
                <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($users as $user) ?>
                  <tr>
                    <th scope="row">
                      <?= $user['id'] ?>
                    </th>
                    <td>
                      <?= $user['nombre'] ?>
                    </td>
                    <td>
                      <?= $user['apellidos'] ?>
                    </td>
                    <td>
                      <a href="mailto:<?= $user['email'] ?>">
                        <?= $user['email'] ?>
                      </a>
                    </td>
                    <td>
                      <?php if($user['estado']): ?>
                        <span class="badge badge-success">
                          ACTIVO
                        </span>
                      <?php endif ?>

                      <?php if(!$user['estado']): ?>
                        <span class="badge badge-success">
                          INACTIVO
                        </span>
                      <?php endif ?>
                    </td>

                    <td>
                      <div class="btn-group" role="group">
                      <button id="btnGroupDrop1" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Acciones
                      </button>
                      <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a data-info="<?= json_encode($user)?>" onclick="edit(this)" class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal">
                          <i class="fa fa-pencil"></i> Editar
                        </a>
                        <a class="dropdown-item" onclick="remove(<?= $user['id'] ?>)" >
                          <i class="fa fa-trash"></i> Eliminar
                        </a>
                      </div>
                    </div>
                    </td>
                  </tr> 
                </tbody>
              </table> 
              </div>
            </div>

          </div>

        </div> 

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form action="" method="POST" onsubmit="return validateForm()">
                <div class="modal-body">

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Nombre</label>
                      <div class="col-sm-10">
                        <input id="nombre" name="name" type="text" class="form-control" >
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Apellidos</label>
                      <div class="col-sm-10">
                        <input id="apellidos" name="last" type="text" class="form-control" >
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input id="email" name="email" type="email" class="form-control" >
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Contraseña</label>
                      <div class="col-sm-10">
                        <input type="password" id="pass" name="pass" class="form-control" >
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="inputPassword" class="col-sm-2 col-form-label">Confirmar contraseña</label>
                      <div class="col-sm-10">
                        <input type="password" id="pass2" name="pass2" class="form-control" id="inputPassword">
                      </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <input type="hidden" name="action" value="store">
                  <input type="hidden" name="id">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>

              </form>

            </div>
          </div>
        </div>

    <script type="text/javascript" src="jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script type="text/javascript">

      function add()
      {
        $('#exampleModalLabel').text('Añadir usuario.');
      }

      function edit(target)
      {
        $('#exampleModalLabel').text('Editar usuario.');
      }

      function validateForm()
      {
          if($('#pass').val() == $('#pass2').val())
          {
            swal("Correcto", "sucess");
            return true;
          }
          else
          {
            swal("Las contraseñas son distintas", "error");
            $('#pass').addClass('is-invalid');
            $('#pass2').addClass('is-invalid');
            return false;
          }
      }

      function remove(id)
      {
        swal({
          title: "",
          text: "¿Desea eliminar el usuario?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            swal("Poof! Your imaginary file has been deleted!", {
              icon: "success",
            });
          } else {
            swal("Your imaginary file is safe!");
          }
        });
      }

    </script>

</body>
</html>