<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Golongan;

class GolonganController extends Controller
{
    //
    public function index(){
        return response()->json(Golongan::all());
    }

    public function getById($Id){
        $golongan = Golongan::find($Id);
        if ($golongan) {
            return response()->json([
                'status' => 200,
                'data' => $golongan
            ],200);
        }else {
            return response()->json([
                'status' => 404,
                'message' => "No Such golongan$golongan Found !"
            ], 404);
        }
    }
}
