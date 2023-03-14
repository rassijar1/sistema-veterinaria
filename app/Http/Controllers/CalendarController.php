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
           $arr = array( "a"=>"yellow", "b"=>"purple", "c"=>"green", "d"=>"red", "e"=>"blue","f"=>"fuchsia");
           shuffle($arr);
 



            $calendar[] = [
                'title'=>$recorridos->title,
                'start' => $recorridos->date_appoinment." ".$recorridos->time_appoinment,
                'color' =>$arr[0]
                
            ];

           


        }


$administradores= Administradores::all();


return view("paginas.calendar", array("calendar"=>$calendar, "administradores"=>$administradores));
        //return view('paginas.calendar', ['calendar' => $calendar]);
    }
}
