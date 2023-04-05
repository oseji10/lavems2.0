<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use DB;
use App\Models\Client;
// use Illuminate\Database\Eloquent\Model;

class InvoiceController extends Controller
{
    public function getInvoices(){

       $invoices = DB::table('invoice')
       ->join('client', 'client.client_id', '=', 'invoice.client_id')
       ->select('invoice.invoice_number', 'invoice.client_id', 'invoice.created_at', 'invoice.equipment_serial_number', 'client.name', 'client.email', DB::raw('sum(invoice.cost) as total'))
       ->groupBy('invoice.invoice_number', 'invoice.client_id', 'invoice.created_at',  'invoice.equipment_serial_number', 'client.name', 'client.email')
       ->distinct()
       ->get();

        // $invoices = Invoice::query()->get();
        return $invoices;
    }





    public function store(Request $request)
{
    // Validate the request data
    $validatedData = dd($request->all())([
        'client_id' => 'required',
        'equipment_serial_numbers.*' => 'required',
        'equipments.*' => 'required',
        'quantities.*' => 'required|integer|min:1'
    ]);

    // Loop through the submitted data and create an invoice item for each record
    foreach ($validatedData['equipment_serial_numbers'] as $key => $value) {
        $invoiceItem = new Invoice;
        $invoiceItem->client_id = $validatedData['client_id'];
        $invoiceItem->equipment_serial_number = $value;
        $invoiceItem->equipment_name = $validatedData['equipments'][$key];
        $invoiceItem->quantity = $validatedData['quantities'][$key];
        $invoiceItem->save();
    }
// return $validatedData;
    // Redirect back with success message
    return redirect()->back()->with('success', 'Invoice added successfully!');
}


}
