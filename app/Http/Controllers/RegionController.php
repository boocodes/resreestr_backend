<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        $REGION_LIST_PATH = "./object_static/region_list.txt";

        $region_list_json = file_get_contents($REGION_LIST_PATH);
        if($region_list_json){
            http_response_code(200);
            return $region_list_json;
        }
        else{
            http_response_code(400);
            return false;
        }


    }
}
