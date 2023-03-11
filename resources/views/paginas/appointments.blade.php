@extends('plantilla')
@section('content')

<div class="content-wrapper" style="min-height: 247px;">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
               <h1>Citas</h1>

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item"><a href="#">Citas</a></li>
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
                
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#crearCitas">Crear Cita</button>

              </div>

              
              <div class="card-body">
                {{-- @foreach ($categorias as $element)
                  {{$element}}
                @--}}
<table border="0" cellspacing="5" cellpadding="5">
        <tbody><tr>
            <h4 class="text-success" align="center">Fecha inicio:</h4>
            <div><input type="text" id="min" class="form-control form-control-sm" name="min"></div>
            
        </tr>
        <br>  
        <tr>
            <h4 class="text-danger" align="center">Fecha fin:</h4>
            <div>
               <input type="text" class="form-control form-control-sm" id="max" name="max">
            </div>
           
        </tr>
        <br>
        <br>
    </tbody></table>
                <table class="table table-bordered table-striped dt-responsive" id="tablaCitas" width="100%">
                  
                  <thead>
                    <tr>
                      
                      <th width="10px">#</th>
                      <th width="50px">Nombre cita</th>
                      <th width="50px">Fecha</th>
                      <th width="50px">Hora</th>
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
Crear Citas
======================================-->

<div class="modal hide fade" id="crearCitas" style=" overflow: scroll">
 
  <div class="modal-dialog">
   
    <div class="modal-content">

      <form method="POST" action="{{url('/')}}/appointments" enctype="multipart/form-data">
        @csrf
      
        <div class="modal-header bg-info">
          
          <h4 class="modal-title">Crear Citas</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        <div class="modal-body">


{{-- titulo cita --}}

            <div class="input-group mb-3">
              
              <div class="input-group-append input-group-text">               
                 <i class="fas fa-list-ul"></i>
              </div>

              <input  type="text" class="form-control" name="titulo_cita" value="{{ old('titulo_cita') }}" placeholder="Ingrese el nombre de la cita">

             

            </div>
            {{-- fecha--}}
 					
  <div class="input-group mb-3">
              
              <div class="input-group-append input-group-text">               
                 <i class="fas fa-calendar"></i>
              </div>
  <input type="text" class="no-outline inputFecha" style="width: 425px; border-color: #eee;       border-width: 1px;
" id="fecha_cita"  name="fecha_cita"  placeholder="Ingrese la fecha de la cita" maxlength="30">


            </div>

            {{-- hora --}}

            <div class="input-group mb-3">
              
              <div class="input-group-append input-group-text">               
                 <i class="fas fa-clock"></i>
              </div>
  <input  type="time" class="form-control inputHora" name="time_cita" value="{{ old('time_cita') }}" >


            </div>

         
                   {{-- mascota  --}}
				<div class="input-group mb-3">
                    
                    <div class="input-group-append input-group-text">
                      <i class="fas fa-paw "></i>
                    </div>

                    <select class="form-control"  name="cita_mascota" required>
                    	  <option value="">Seleccione Mascota</option>
					@foreach ($pets as $element => $value)
									

                     
                      
                        <option value="{{$value["id_mascota"]}}">{{$value["nombre"]}} </option>
                        


                    
								@endforeach
                    </select>

                  </div>
           


        </div>

        <div class="modal-footer d-flex justify-content-between">
          
          <div>
            <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
          </div>

          <div>
            <button type="submit"  class="btn btn-primary">Guardar</button>
          </div>

        </div>

      </form>

    </div> 

  </div> 

</div>


 


@if (isset($status))

@if ($status==200)
@foreach ($appointments as $key => $value1)
  
      <div class="modal" id="editarCitas">

        <div class="modal-dialog">

          <div class="modal-content">

            <form action="{{url('/')}}/appointments/{{$value1->id}}" method="post" enctype="multipart/form-data">

              @method('PUT')

              @csrf
              
              <div class="modal-header bg-info">
                
                <h4 class="modal-title">Editar Cita</h4>

                <button type="button" class="close" data-dismiss="modal">&times;</button>

              </div>

              <div class="modal-body">
                
                {{-- titulo cita --}}

            <div class="input-group mb-3">
              
              <div class="input-group-append input-group-text">               
                 <i class="fas fa-list-ul"></i>
              </div>

              <input  type="text" class="form-control" name="titulo_cita_edit" value="{{$value1["title"]}}">

             

            </div>
                

            {{-- fecha--}}
          
  <div class="input-group mb-3">
              
              <div class="input-group-append input-group-text">               
                 <i class="fas fa-calendar"></i>
              </div>
  <input  type="text" class="no-outline" id="fecha_cita_edit" name="fecha_cita_edit"style="width: 425px; border-color: #eee;border-width: 1px" value="{{$value1["date_appointment"]}}">


            </div>

            {{-- hora --}}

            <div class="input-group mb-3">
              
              <div class="input-group-append input-group-text">               
                 <i class="fas fa-clock"></i>
              </div>
  <input  type="time" class="form-control" name="time_cita_edit" value="{{$value1["time_appointment"]}}">


            </div>


         
                   {{-- mascota  --}}
				<div class="input-group mb-3">
                    
                    <div class="input-group-append input-group-text">
                      <i class="fas fa-paw"></i>
                    </div>

                    <select class="form-control"  name="cita_mascota_edit" required>
                    	  <option value="">Seleccione Mascota</option>
					@foreach ($pets as $element => $value)
									

                     
                      
                        <option value="{{$value["id_mascota"]}}">{{$value["nombre"]}} </option>
                        


                    
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

    <script>$("#editarCitas").modal()</script>
@endif
  
@endif


@if (Session::has("ok-crear"))

  <script>
      notie.alert({ type: 1, text: '¡La cita ha sido creada correctamente!', time: 10 })
 </script>

@endif

 @if (Session::has("no-validacion"))

<script>
    notie.alert({ type: 2, text: '¡Hay campos no válidos en el formulario!', time: 10 })
</script>

@endif

 @if (Session::has("error"))

<script>
    notie.alert({ type: 3, text: '¡Error en el gestor citas!', time: 10 })
</script>

@endif

@if (Session::has("ok-editar"))

  <script>
      notie.alert({ type: 1, text: '¡La cita ha sido actualizada correctamente!', time: 10 })
 </script>

@endif

@if (Session::has("no-borrar"))

  <script>
      notie.alert({ type: 3, text: '¡Error al borrar la cita!', time: 10 })
 </script>

@endif
    @endsection