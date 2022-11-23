<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function index()
    {
        $cities = City::all();
        return view('city', compact('cities'));
    }


    public function store(Request $request)
    {
        $city = City::create($request->all());
        if ($city) {
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
