<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
class RosterController extends Controller
{
    protected $json_data = "data.json";
    
    function getRoster()
    {
        $data = json_decode(file_get_contents(storage_path() . "/app/json/" . $this->json_data));
        //return print_r($data);
        return json_encode($data);
    }
}