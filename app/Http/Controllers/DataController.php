<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataController extends Controller
{

    public function index()
    {
        return view('vueform');
    }

    public function saveData(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);
        Data::create($validatedData);


        return response()->json(['message' => 'Data saved successfully']);
    }
}
