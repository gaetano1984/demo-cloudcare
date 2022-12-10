<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PunkApiRequest;
use \GuzzleHttp\Client;
use \GuzzleHttp\HandlerStack;

class PunkApiController extends Controller
{
    //
    public function searchBeer(Request $request){

        $validator = \Validator::make($request->all(), PunkApiRequest::rules());
        if ($validator->fails()) {
            return response()->json(['res' => 'ko', 'errors' => $validator->messages()]);
        }

        $client = new Client();
        $stack = HandlerStack::create();

        $headers = [
            'token' => $request->get('token')
        ];

        $param = [];
        if($request->has('page')){
            $param['page'] = $request->get('page');
        }
        if($request->has('per_page')){
            $param['per_page'] = $request->get('per_page');
        }

        try{
            $request = $client->request(
                'GET',
                config('punkapi.url'),
                [
                    'handler' => $stack,
                    'headers' => $headers,
                    'query' => $param
                ]
            );
    
            $body = $request->getBody();
    
            $s = "";
            while($s_temp = $body->read(1024)){
                $s .= $s_temp;
            }
            $s = json_decode($s);
            return response()->json(['beer' => $s], 200);
        }
        catch(\Exception $e){
            throw $e;
        }
        
    }
}
