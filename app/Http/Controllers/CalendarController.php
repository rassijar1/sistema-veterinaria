<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendar;
use App\Models\Administradores;
class CalendarController extends Controller
{
     public function index()
    {
        $calendar = array();
        $recorrer = Calendar::all();

        
        foreach($recorrer as $recorridos) {
           $hora=$recorridos->time_appoinment;

            $calendar[] = [
                'title'=>$recorridos->title." Hora: "." ".$hora,
                'start' => $recorridos->date_appoinment
                
            ];

           


        }


$administradores= Administradores::all();


return view("paginas.calendar", array("calendar"=>$calendar, "administradores"=>$administradores));
        //return view('paginas.calendar', ['calendar' => $calendar]);
    }
}
