<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pets;
use App\Models\Appointment;
use App\Models\Administradores;


class AppointmentController extends Controller
{
    public function index(){



	if(request()->ajax()){

			  return datatables()->of(Appointment::all())
			  

			  ->addColumn('acciones', function($data){

                               $acciones = '<div class="btn-group">
								
								<a href="'.url()->current().'/'.$data->id.'" class="btn btn-warning btn-sm">
									<i class="fas fa-pencil-alt text-white"></i>
								</a>

								<button class="btn btn-danger btn-sm eliminarRegistro" action="'.url()->current().'/'.$data->id.'" method="DELETE" pagina="appointments" token="'.csrf_token().'">
								<i class="fas fa-trash-alt"></i>
								</button>

			  				</div>';

			  	return $acciones;


			  })
			  ->rawColumns(['acciones'])
			  -> make(true);

		}

$pets= Pets::all();
$appointments= Appointment::all();
$administradores= Administradores::all();


return view("paginas.appointments", array("pets"=>$pets, "appointments"=>$appointments,"administradores"=>$administradores));


}

/*=============================================
	Crear una Cita
	=============================================*/

	public function store(Request $request){

		//recoger datos


		$datos=array(
                     "title" => $request->input("titulo_cita"), 
                    "date_appoinment" => $request->input("fecha_cita"), 
			         "time_appoinment" => $request->input("time_cita"),
			         "id_mascota_fk" => $request->input("cita_mascota")
			        




	);

		// Validar datos
    	if(!empty($datos)){

    		$validar = \Validator::make($datos,[
                "title"=> "required|regex:/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i",
    			"date_appoinment"=> "required| ",
    			"time_appoinment"=> "required|",
    			"id_mascota_fk"=> 'required|'
    			
    		]);



    		//Guardar categoría
    	
                $appointments = new Appointment();
                $appointments->title = $datos["title"];
                $appointments->date_appoinment = $datos["date_appoinment"];
                $appointments->time_appoinment = $datos["time_appoinment"];
                $appointments->id_mascota_fk = $datos["id_mascota_fk"];

                $appointments->save(); 

                return redirect("/appointments")->with("ok-crear", "");   


    		


    	}else{

    		return redirect("/appointments")->with("error", "");
    	}




	}


	/*=============================================
    Mostrar una sola cita
    =============================================*/

    public function show($id){   

        $appointments = Appointment::where('id', $id)->get();
        $administradores = Administradores::all();
		$pets= Pets::all();
        if(count($appointments) != 0){

            return view("paginas.appointments", array("status"=>200, "pets"=>$pets, "administradores"=>$administradores,"appointments"=>$appointments)); 
        }

        else{
            
            return view("paginas.categorias", array("status"=>404, "pets"=>$pets,"administradores"=>$administradores,"appointments"=>$appointments));

        }

    }

     /*=============================================
    Editar una cita
    =============================================*/

    public function update($id, Request $request){

        // Recoger los datos

      	$datos=array(
                "title" => $request->input("titulo_cita_edit"),
                "date_appoinment" => $request->input("fecha_cita_edit"), 
			         "time_appoinment" => $request->input("time_cita_edit"),
			         "id_mascota_fk" => $request->input("cita_mascota_edit")
			        




	);

      
        // Validar los datos

        if(!empty($datos)){

           
    		$validar = \Validator::make($datos,[
                "title"=> "required|regex:/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i",
    			"date_appoinment"=> "required| ",
    			"time_appoinment"=> "required|",
    			"id_mascota_fk"=> 'required|'
    			
    		]);


           

            if($validar->fails()){

                return redirect("/appointments")->with("no-validacion", "");

            }else{


                $datos = array(
                    "title" => $datos["title"],
                    "date_appoinment" => $datos["date_appoinment"],
                                "time_appoinment" => $datos["time_appoinment"],
                                "id_mascota_fk" => $datos["id_mascota_fk"]
                                );

                $appointments = Appointment::where('id', $id)->update($datos); 

                return redirect("/appointments")->with("ok-editar", "");

            }

        }else{

           return redirect("/appointments")->with("error", ""); 

        }


    }

     /*=============================================
    Eliminar una cita
    =============================================*/

    public function destroy($id, Request $request){ 

        $validar = Appointment::where("id", $id)->get();
        
        if(!empty($validar)){

            

            $appointments = Appointment::where("id",$validar[0]["id"])->delete();

            //Responder al AJAX de JS
            return "ok";
        
        }else{

            return redirect("/appointments")->with("no-borrar", "");   

        }

    }

}
