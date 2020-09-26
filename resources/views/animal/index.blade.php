<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css"/>

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Laravel 8 con Ajax</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Animales</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Mantenimiento
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Propietarios</a>
          <a class="dropdown-item" href="#">Médicos</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Citas</a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
    </form>
  </div>
</nav>

<div class="container">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Lista de Animales</a>
        </li>
        <li class="nav-item" role="presentation">
            {{-- <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Nuevo Animal</a> --}}
        </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <h3></h3>
                <br>
                <table id="tabla-animal" class="table table-hover">
                    <thead>
                        <td>ID</td>
                        <td>NOMBRE</td>
                        <td>ESPECIE</td>
                        <td>GENERO</td>
                        <td>ACCIONES</td>
                    </thead>

                </table>


            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <h3></h3>
                <br>
                <form id="registro-animal">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre</label>
                    <input type="text" class="form-control" id="txtNombre" name="txtNombre" aria-describedby="emailHelp">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Especie</label>
                    <select class="form-control" id="selEspecie" name="selEspecie">
                    <option value="Gato">Gato</option>
                    <option value="Perro">Perro</option>
                    <option value="Ave">Ave</option>
                    <option value="Otros">Otros</option>

                    </select>
                </div>
                <div class="form-group">
                    <label for="">Genero</label>

                    <div class="custom-control custom-radio">
                    <input type="radio" id="rbGeneroMacho" name="rbGenero" value="Macho">
                    <label>Macho</label>
                    </div>
                    <div class="custom-control custom-radio">
                    <input type="radio" id="rbGeneroHembra" name="rbGenero" value="Hembra">
                    <label>Hembra</label>

                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Registrar</button>
                </form>



            </div>

        </div>


<!--modal para editar datos-->


<!-- Modal -->
<div class="modal fade" id="animal_edit_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Editar Animal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form id="animal_edit_form">

      <div class="modal-body">


                @csrf

                <input type="hidden" id="txtId2" name="txtId2">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre</label>
                    <input type="text" class="form-control" id="txtNombre2" name="txtNombre2" aria-describedby="emailHelp">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Especie</label>
                    <select class="form-control" id="selEspecie2" name="selEspecie2">
                    <option value="Gato">Gato</option>
                    <option value="Perro">Perro</option>
                    <option value="Ave">Ave</option>
                    <option value="Otros">Otros</option>

                    </select>
                </div>
                <div class="form-group">
                    <label for="">Genero</label>

                    <div class="custom-control custom-radio">
                    <input type="radio" id="rbGeneroMacho2" name="rbGenero2" value="Macho">
                    <label>Macho</label>
                    </div>
                    <div class="custom-control custom-radio">
                    <input type="radio" id="rbGeneroHembra2" name="rbGenero2" value="Hembra">
                    <label>Hembra</label>

                    </div>
                </div>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Actualizar</button>
      </div>
      </form>

    </div>
  </div>
</div>





<!-- Modal eliminar -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Desea eliminar el registro seleccionado?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="btnEliminar" name="btnEliminar" class="btn btn-danger">Eliminar</button>
      </div>
    </div>
  </div>
</div>

</div><!--fin container-->

<script>
//LISTAR REGISTROS CON DATATABLE
$(document).ready(function(){
    var tablaAnimal = $('#tabla-animal').DataTable({
        processing:true,
        serverSide:true,
        ajax:{
            url: "{{ route('animal.index') }}",
        },
        columns:[
            {data: 'id'},
            {data: 'nombre'},
            {data: 'especie'},
            {data: 'genero'},
            {data: 'action', orderable: false}
        ]
    });
});

</script>

<script>
// REGISTRAR NUEVO ANIMAL
    $('#registro-animal').submit(function(e){
        e.preventDefault();

        var nombre = $('#txtNombre').val();
        var especie = $('#selEspecie').val();
        var genero = $("input[name='rbGenero']:checked").val();
        var _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{ route('animal.registrar') }}",
            type: "POST",
            data:{
                nombre: nombre,
                especie: especie,
                genero: genero,
                _token:_token

            },
            success:function(response){
                if(response){
                    $('#registro-animal')[0].reset();
                    toastr.success('El registro se ingreso correctamente.', 'Nuevo Registro', {timeOut:3000});
                    $('#tabla-animal').DataTable().ajax.reload();
                }
            }
        });

    });

</script>

<script>
// ELIMINAR UN REGISTRO
var ani_id;

$(document).on('click', '.delete', function(){
    ani_id = $(this).attr('id');
    $('#confirmModal').modal('show');
});

$('#btnEliminar').click(function(){

    $.ajax({
        url:"animal/eliminar/"+ani_id,
        beforeSend:function(){
            $('#btnEliminar').text('Eliminando...');
        },
        success:function(data){
            setTimeout(function(){
                $('#confirmModal').modal('hide');
                toastr.warning('El registro fue eliminado correctamente.', 'Eliminar Registro', {timeOut:3000});
                $('#tabla-animal').DataTable().ajax.reload();

            }, 2000);
            $('#btnEliminar').text('Eliminar');
        }
    });
});

</script>

<script>
//EDITAR UN REGISTRO
    function editarAnimal(id){
        $.get('animal/editar/'+id, function(animal){
            //asignar los datos recuperados a la ventana modal
            $('#txtId2').val(animal[0].id);
            $('#txtNombre2').val(animal[0].nombre);
            $('#selEspecie2').val(animal[0].especie);

            //$('#rbGenero2').val(animal[0].genero);
            if(animal[0].genero == "Macho"){
                $('input[name=rbGenero2][value="Macho"]').prop('checked', true);
            }
            if(animal[0].genero == "Hembra"){
                $('input[name=rbGenero2][value="Hembra"]').prop('checked', true);
            }
            $("input[name=_token]").val();
            $('#animal_edit_modal').modal('toggle');
        })

    }


</script>

<script>

//ACTUALIZAR UN REGISTRO
$('#animal_edit_form').submit(function(e){

    e.preventDefault();
    var id2 = $('#txtId2').val();
    var nombre2 = $('#txtNombre2').val();
    var especie2 = $('#selEspecie2').val();
    var genero2 = $("input[name='rbGenero2']:checked").val();
    var _token2 = $("input[name=_token]").val();

    $.ajax({
        url: "{{ route('animal.actualizar') }}",
        type: "POST",
        data:{
            id:id2,
            nombre:nombre2,
            especie:especie2,
            genero:genero2,
            _token:_token2
        },
        success:function(response){
            if(response){
                $('#animal_edit_modal').modal('hide');
                toastr.info('El registro fue actualizado correctamente.', 'Actualizar Registro', {timeOut:3000});
                $('#tabla-animal').DataTable().ajax.reload();
            }
        }

    })

});

</script>



</body>
</html>
