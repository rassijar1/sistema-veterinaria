@extends('plantilla')
@section('content')

<div class="content-wrapper" style="min-height: 247px;">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
               <h1>Calendario</h1>

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item"><a href="#">Calendario</a></li>
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
              

              
              
             
              <div class="card-body">
                {{-- @foreach ($categorias as $element)
                  {{$element}}
                @--}}

                
                  
                  <div id="calendar">

                    </div>


               
              </div>
              <!-- /.card-body -->
              
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
</div>


<script>
    

$(document).ready(function(){

            var calendar=@json($calendar);
            console.log("calendar", calendar);

            $('#calendar').fullCalendar({

                header: {
                    left: 'prev, next today',
                    center: 'title',
                    right: 'month, agendaWeek, agendaDay',
                },
                 locale: 'es',
                events: calendar
                


            });

        });
</script>

  
    @endsection