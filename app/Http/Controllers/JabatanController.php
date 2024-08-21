<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jabatan;

class JabatanController extends Controller
{
    //
    public function index(){
        return response()->json(Jabatan::all());
    }

    public function getById($Id){
        $jabatan = Jabatan::find($Id);
        if ($jabatan) {
            return response()->json([
                'status' => 200,
                'data' => $jabatan
            ],200);
        }else {
            return response()->json([
                'status' => 404,
                'message' => "No Such Jabatan Found !"
            ], 404);
        }
    }

    
}
