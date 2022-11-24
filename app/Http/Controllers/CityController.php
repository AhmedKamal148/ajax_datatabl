<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function index()
    {
        $cities = City::get();
        return view('city', compact('cities'));
    }

    public function getData()
    {
        $cities = City::get();
        if ($cities) {
            return response()->json([
                "code" => 200,
                'messages' => 'Data Found',
                'data' => $cities,
            ]);
        } else {
            return response()->json([
                "code" => 500,
                'messages' => 'internal server error',
            ]);
        }
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

    public function edit(Request $request)
    {
        $result = City::find($request->id);
        if ($result) {
            return response()->json([
                'message' => 'Data Found',
                'code' => 200,
                'data' => $result,
            ]);
        } else {
            return response()->json(
                [
                    'message' => "Internal Server Error",
                    'code' => 500,
                ]
            );
        }
    }


    public function update(Request $request)
    {

        $result = City::find($request->city_id);
        $result->update([
            'name' => $request->edit_Name,
        ]);
        if ($result) {
            return response()->json([
                'message' => 'Data Update',
                'code' => 200,
                'data' => $result,
            ]);
        } else {
            return response()->json([
                'message' => 'internal server',
                'code' => 500,

            ]);
        }

    }


    public function delete(Request $request)
    {
        $result = City::find($request->id);
        $result->delete();
        if ($result) {
            return response()->json([
                'message' => 'Delete City Successfully',
                'code' => 200
            ]);
        } else {
            return response()->json([
                'message' => 'internal error',
                'code' => 500
            ]);
        }
    }
}
