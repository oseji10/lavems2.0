<?php

namespace App\Http\Controllers;
use App\Models\EDI;
use Illuminate\Http\Request;

class EDIController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'edi_name' => 'required|string',
      ]);
      // \Log::info($request->all());
      $edi = new EDI();
      $edi->edi_name = $request->edi_name;
      $edi->created_by = auth()->id();
      $edi->save();

      return response()->json([
        'status' => 'success',
        'message' => 'EDI created successfully',
        'edi' => $edi,

    ]);
    }

    public function fetchEdis(){
        $edi = EDI::all();
        return response()->json([
            'message' => 'Retrieved EDIs',
            'status' => 'success',
            'edis' => $edi
        ]);
    }
}
