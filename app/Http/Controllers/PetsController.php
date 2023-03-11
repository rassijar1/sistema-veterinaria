<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pets;
use App\Models\Administradores;
use App\Models\TypePet;
class PetsController extends Controller
{
    

public function index(){



	if(request()->ajax()){

			  return datatables()->of(Pets::all())
			  

			  ->addColumn('acciones', function($data){

                               $acciones = '<div class="btn-group">
								
								<a href="'.url()->current().'/'.$data->id_mascota.'" class="btn btn-warning btn-sm">
									<i class="fas fa-pencil-alt text-white"></i>
								</a>

								<button class="btn btn-danger btn-sm eliminarRegistro" action="'.url()->current().'/'.$data->id_mascota.'" method="DELETE" pagina="pets" token="'.csrf_token().'">
								<i class="fas fa-trash-alt"></i>
								</button>

			  				</div>';

			  	return $acciones;


			  })
			  ->rawColumns(['acciones'])
			  -> make(true);

		}

$pets= Pets::all();
$administradores= Administradores::all();
$TypePet= TypePet::all();


return view("paginas.pets", array("pets"=>$pets, "administradores"=>$administradores,"TypePet"=>$TypePet));


}



/*=============================================
	Crear una mascota
	=============================================*/

	public function store(Request $request){

		//recoger datos


		$datos=array("id_tipomascota_fk" => $request->input("tipo_mascota"), 
			         "nombre" => $request->input("nombre_mascota"),
			         "id_cliente_fk" => $request->input("cliente_mascota")
			        




	);

		// Validar datos
    	if(!empty($datos)){

    		$validar = \Validator::make($datos,[

    			"id_tipomascota_fk"=> "required|regex:/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i",
    			"nombre"=> "required|regex:/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i",
    			"id_cliente_fk"=> 'required|regex:/^[,\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i'
    			
    		]);



    		//Guardar categoría
    	
                $pets = new pets();
                $pets->id_tipomascota_fk = $datos["id_tipomascota_fk"];
                $pets->nombre = $datos["nombre"];
                $pets->id_cliente_fk = $datos["id_cliente_fk"];

                $pets->save(); 

                return redirect("/pets")->with("ok-crear", "");   


    		


    	}else{

    		return redirect("/pets")->with("error", "");
    	}




	}



    /*=============================================
    Mostrar una sola mascota
    =============================================*/

    public function show($id){   

        $pets = Pets::where('id_mascota', $id)->get();
        $administradores = Administradores::all();
		$TypePet= TypePet::all();
        if(count($pets) != 0){

            return view("paginas.pets", array("status"=>200, "pets"=>$pets, "TypePet"=>$TypePet, "administradores"=>$administradores)); 
        }

        else{
            
            return view("paginas.categorias", array("status"=>404, "pets"=>$pets, "TypePet"=>$TypePet, "administradores"=>$administradores));

        }

    }

     /*=============================================
    Editar una mascota
    =============================================*/

    public function update($id, Request $request){

        // Recoger los datos

         $datos=array("id_tipomascota_fk" => $request->input("tipo_mascota_edit"), 
			         "nombre" => $request->input("nombre_mascota_edit"),
			         "id_cliente_fk" => $request->input("cliente_mascota_edit")
			        




	);

      
        // Validar los datos

        if(!empty($datos)){

           $validar = \Validator::make($datos,[

    			"id_tipomascota_fk"=> "required|",
    			"nombre"=> "required|",
    			"id_cliente_fk"=> 'required|'
    			
    		]);


           

            if($validar->fails()){

                return redirect("/pets")->with("no-validacion", "");

            }else{


                $datos = array("id_tipomascota_fk" => $datos["id_tipomascota_fk"],
                                "nombre" => $datos["nombre"],
                                "id_cliente_fk" => $datos["id_cliente_fk"]
                                );

                $categoria = Pets::where('id_mascota', $id)->update($datos); 

                return redirect("/pets")->with("ok-editar1", "");

            }

        }else{

           return redirect("/pets")->with("error", ""); 

        }


    }

     /*=============================================
    Eliminar un registro
    =============================================*/

    public function destroy($id, Request $request){ 

        $validar = Pets::where("id_mascota", $id)->get();
        
        if(!empty($validar)){

            

            $pets = Pets::where("id_mascota",$validar[0]["id_mascota"])->delete();

            //Responder al AJAX de JS
            return "ok";
        
        }else{

            return redirect("/pets")->with("no-borrar", "");   

        }

    }

}


