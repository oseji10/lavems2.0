<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubVendor;
use DB;
use App\Models\Invoice;
use App\Models\Client;
use Illuminate\Http\Response;

class SubVendorController extends Controller
{
    public function getPayments(){
        $payments = DB::table('subvendor')
         ->join('client', 'client.client_id', '=', 'subvendor.client_id')
         ->select('subvendor.id','subvendor.invoice_number', 'subvendor.client_id', 'subvendor.created_at', 'subvendor.amount_payable', 'subvendor.amount', 'client.name', 'subvendor.captured_by', DB::raw('sum(subvendor.amount) as total'))
         ->groupBy('subvendor.id', 'subvendor.invoice_number', 'subvendor.client_id', 'subvendor.created_at', 'subvendor.amount_payable', 'subvendor.amount', 'client.name', 'subvendor.captured_by',)
         ->distinct()
         ->orderBy('id', 'desc')
         ->get();

          return $payments;
      }


      public function clientReceipt(Request $request, $id){
        $receipt = DB::table('invoice')
        ->join('client', 'client.client_id', '=', 'invoice.client_id')
        ->select('invoice.id','invoice.invoice_number', 'invoice.client_id', 'invoice.created_at', 'invoice.equipment_serial_number', 'invoice.equipment', 'invoice.quantity', 'invoice.cost', 'client.name', 'client.nature_of_business', 'client.contact_address', 'client.phone_number')
        ->groupBy('invoice.id', 'invoice.invoice_number', 'invoice.client_id', 'invoice.created_at', 'invoice.equipment_serial_number', 'invoice.equipment', 'client.name', 'client.nature_of_business', 'client.contact_address', 'client.phone_number')
        // ->distinct()
        ->where('invoice_number', '=', $id)
        ->orderBy('id', 'desc')
        ->get();
        // $pdf = Client::find($id);
        return response()->json($receipt);
    }

}
