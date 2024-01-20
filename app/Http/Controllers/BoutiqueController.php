<?php

namespace App\Http\Controllers;

use App\Models\BoutiqueModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class BoutiqueController extends Controller
{
    public function thisBoutique(Request $request,$butik_name){
        $id = $request->input('id');
        $boutique = BoutiqueModel::where('id',$id)->get()->first();

        return view('templates.thisBoutique',compact('boutique'));
    }
}
