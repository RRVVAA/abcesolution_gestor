<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\IbptImport;
use App\Models\Ibpt;
use App\Models\Estado;

class IbptController extends Controller
{
    
    public function index()
    {       
        $dados["lista"] = Ibpt::limit(500)->get();
        return view("Ibpt.Index", $dados);
    }
   
    public function create()
    {
        $dados["estados"] = Estado::get();
        return view("Ibpt.Create", $dados);
    }

    public function store(Request $request){
        Ibpt::where("uf", $request->uf)->delete();    
        Excel::import(new IbptImport($request->uf), request()->file('file'));
        return redirect()->route("ibpt.index");
    }
  
}
