@extends('plantilla')
@section('content')

<div class="content-wrapper" style="min-height: 247px;">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
               <h1>Mascotas</h1>

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item"><a href="#">Mascotas</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#crearMascota">Crear Mascota</button>

              </div>
              <div class="card-body">
                {{-- @foreach ($categorias as $element)
                  {{$element}}
                @--}}

                <table class="table table-bordered table-striped dt-responsive" id="tablaMascotas" width="100%">
                  
                  <thead>
                    <tr>
                      
                      <th width="10px">#</th>
                      <th width="50px">Nombre</th>
                      <th width="50px">Acciones</th>
                    </tr>

                  </thead>

                    <tbody>
                      


                    </tbody>


                </table>
              </div>
              <!-- /.card-body -->
              
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
</div>
<!--=====================================
Crear Mascota
======================================-->

<div class="modal" id="crearMascota">
 
  <div class="modal-dialog">
   
    <div class="modal-content">

      <form method="POST" action="{{url('/')}}/pets" enctype="multipart/form-data">
        @csrf
      
        <div class="modal-header bg-info">
          
          <h4 class="modal-title">Crear Mascotas</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        <div class="modal-body">

            {{-- Tipo mascota--}}
 					<div class="input-group mb-3">
                    
                    <div class="input-group-append input-group-text">
                      <i class="fas fa-feather-alt"></i>
                    </div>

                    <select class="form-control"  name="tipo_mascota" required>
                    	  <option value="">seleccione Tipo mascota</option>
					@foreach ($TypePet as $element => $value)
									

                     
                      
                        <option value="{{$value["id_tipo_mascota"]}}">{{$value["tipo_mascota"]}} </option>
                        


                    
								@endforeach
                    </select>

                  </div>
  

            {{-- Nombre mascota --}}

            <div class="input-group mb-3">
              
              <div class="input-group-append input-group-text">               
                 <i class="fas fa-otter"></i>
              </div>
  <input  type="text" class="form-control" name="nombre_mascota" value="{{ old('nombre_mascota') }}" placeholder="Ingrese el nombre de la mascota" maxlength="30">


            </div>

         
                   {{-- Cliente  --}}
				<div class="input-group mb-3">
                    
                    <div class="input-group-append input-group-text">
                      <i class="fas fa-user"></i>
                    </div>

                    <select class="form-control"  name="cliente_mascota" required>
                    	  <option value="">seleccione cliente</option>
					@foreach ($administradores as $element => $value)
									

                     
                      
                        <option value="{{$value["id"]}}">{{$value["name"]}} </option>
                        


                    
								@endforeach
                    </select>

                  </div>
           


        </div>

        <div class="modal-footer d-flex justify-content-between">
          
          <div>
            <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
          </div>

          <div>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>

        </div>

      </form>

    </div> 

  </div> 

</div>


@if (isset($status))

@if ($status==200)
@foreach ($pets as $key => $value1)
  
      <div class="modal" id="editarMascotas">

        <div class="modal-dialog">

          <div class="modal-content">

            <form action="{{url('/')}}/pets/{{$value1->id_mascota}}" method="post" enctype="multipart/form-data">

              @method('PUT')

              @csrf
              
              <div class="modal-header bg-info">
                
                <h4 class="modal-title">Editar Mascota</h4>

                <button type="button" class="close" data-dismiss="modal">&times;</button>

              </div>

              <div class="modal-body">
                
                 {{-- tipo_mascota --}}

                  

                <div class="input-group mb-3">
                    
                    <div class="input-group-append input-group-text">
                      <i class="fas fa-feather-alt"></i>
                    </div>

                    <select class="form-control"  name="tipo_mascota_edit" required>
                    	  <option value="">seleccione Tipo mascota</option>
					@foreach ($TypePet as $element => $value)
									

                     
                      
                        <option value="{{$value["id_tipo_mascota"]}}">{{$value["tipo_mascota"]}} </option>
                        


                    
								@endforeach
                    </select>

                  </div>

                

            {{-- Nombre mascota --}}

            <div class="input-group mb-3">
              
              <div class="input-group-append input-group-text">               
                 <i class="fas fa-otter"></i>
              </div>
  <input  type="text" class="form-control" name="nombre_mascota_edit" value="{{$value1["nombre"]}}" placeholder="Ingrese el nombre de la mascota" maxlength="30">


            </div>

         
                   {{-- Cliente  --}}
				<div class="input-group mb-3">
                    
                    <div class="input-group-append input-group-text">
                      <i class="fas fa-user"></i>
                    </div>

                    <select class="form-control"  name="cliente_mascota_edit" required>
                    	  <option value="">seleccione cliente</option>
					@foreach ($administradores as $element => $value)
									

                     
                      
                        <option value="{{$value["id"]}}">{{$value["name"]}} </option>
                        


                    
								@endforeach
                    </select>

                  </div>
           
                


                

              </div>

              <div class="modal-footer d-flex justify-content-between">
                
                <div>
                  <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                </div>

                <div>
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>

              </div>

            </form>

          </div>
          
        </div>

      </div>

    @endforeach

    <script>$("#editarMascotas").modal()</script>
@endif
  
@endif


@if (Session::has("ok-crear"))

  <script>
      notie.alert({ type: 1, text: '¡La Mascota ha sido creada correctamente!', time: 10 })
 </script>

@endif

 @if (Session::has("no-validacion"))

<script>
    notie.alert({ type: 2, text: '¡Hay campos no válidos en el formulario!', time: 10 })
</script>

@endif

 @if (Session::has("error"))

<script>
    notie.alert({ type: 3, text: '¡Error en el gestor mascotas!', time: 10 })
</script>

@endif

@if (Session::has("ok-editar1"))

  <script>
      notie.alert({ type: 1, text: '¡La mascota ha sido actualizada correctamente!', time: 10 })
 </script>

@endif

@if (Session::has("no-borrar"))

  <script>
      notie.alert({ type: 3, text: '¡Error al borrar la mascota!', time: 10 })
 </script>

@endif
    @endsection