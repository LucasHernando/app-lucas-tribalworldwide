<?php

namespace App\Http\Controllers;

use Illuminate\Http\{Request, Response};
use Illuminate\Support\Facades\Http;

class ClientController extends Controller
{
    public function getClient()
    {

        try {
            $limite = 25;
            $urlApi = 'https://api.chucknorris.io/jokes/random';

            $dataResponse = array();
            
                for ($i=0; $i < $limite ; $i++) { 
                    $response = Http::get($urlApi);
                    $data = json_decode($response->body());
                    
                    $validate = array_search($data->id, $dataResponse);

                    if (empty($validate)) {
                        $dataResponse[][$data->id] = $data;
                    }
                }
            
            return response()->json(['status'=>Response::HTTP_OK, 
            'message'=> 'Data returned successfully', 'data'=> $dataResponse]);
        } catch (Exception $e) {
            return response()->json(['status'=>400, 
            'message'=> 'Data not returned '. $e->getMessage(), 'data'=>[]]);
        }
    }
}
