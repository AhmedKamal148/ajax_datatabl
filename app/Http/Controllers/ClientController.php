<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index()
    {
        $cities = City::all();
        return view('client', compact('cities'));
    }


    public function store(Request $request)
    {
        $client = Client::create($request->all());

        if ($client) {
            return response()->json([
                "code" => 200,
                'messages' => 'Data Created Successfully',
            ]);
        } else {
            return response()->json([
                "code" => 500,
                'messages' => 'internal server error',
            ]);
        }

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
