<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use DB;
use App\Models\Client;
// use Illuminate\Database\Eloquent\Model;

class InvoiceController extends Controller
{
    // public function getInvoices(){

    //     $invoices = DB::table('invoice')
    //     ->join('client', 'client.client_id', '=', 'invoice.client_id')
    //     ->join('users', 'users.id', '=', 'invoice.created_binvoiced_byy')
    //     ->select('invoice.invoice_number', 'invoice.client_id', 'invoice.created_at', 'invoice.equipment_serial_number', 'client.name', 'client.email', DB::raw('concat(users.first_name, " ", users.last_name) as full_name'), DB::raw('sum(invoice.cost) as total'))
    //     ->groupBy('invoice.invoice_number', 'invoice.client_id', 'invoice.created_at',  'invoice.equipment_serial_number', 'client.name', 'client.email', 'full_name')
    //     ->orderBy('created_at', 'desc')
    //     ->distinct()
    //     ->get();




    //     // $invoices = Invoice::query()->get();
    //     return $invoices;
    // }

    // public function getInvoices(){
    //     $invoices = DB::table('invoice')
    //     ->join('client', 'client.client_id', '=', 'invoice.client_id')
    //     ->join('users', 'users.id', '=', 'invoice.created_binvoiced_byy')
    //     ->select('invoice.invoice_number', 'invoice.client_id', 'invoice.created_at', 'invoice.equipment_serial_number', 'client.name', 'client.email', DB::raw('concat(users.first_name, " ", users.last_name) as full_name'), DB::raw('sum(invoice.cost*invoice.quantity) as grand_total'))

    //         // ->select('invoice.id', 'invoice.invoice_number', 'invoice.client_id', 'invoice.created_at', 'invoice.equipment_serial_number', 'invoice.equipment', 'invoice.quantity', 'invoice.cost', 'client.name', 'client.nature_of_business', 'client.contact_address', 'client.phone_number', DB::raw('sum(invoice.cost*invoice.quantity) as grand_total'))
    //         // ->where('invoice_number', '=', $id)
    //         ->groupBy('invoice.id', 'invoice.invoice_number', 'invoice.client_id', 'invoice.created_at', 'invoice.equipment_serial_number', 'invoice.equipment', 'client.name', 'client.nature_of_business', 'client.contact_address', 'client.phone_number', 'client.email')
    //         ->orderBy('invoice.id', 'desc')
    //         ->distinct()
    //         ->get();

    //     $grandTotal = $invoices->sum('grand_total');
    //     // dd($receipt);
    //     return response()->json([
    //         'invoice' => $invoices,
    //         'grand_total' => $grandTotal
    //     ]);
    // }


        public function getInvoices(){

            $invoices = DB::table('invoice')
            ->join('client', 'client.client_id', '=', 'invoice.client_id')
            ->join('users', 'users.id', '=', 'invoice.created_binvoiced_byy')
            ->select('invoice.invoice_number', 'invoice.client_id', 'invoice.created_at', 'invoice.equipment_serial_number', 'client.name', 'client.email', DB::raw('concat(users.first_name, " ", users.last_name) as full_name'), DB::raw('sum(invoice.cost*invoice.quantity) as grand_total'), DB::raw('sum(invoice.cost*invoice.quantity) as total'))
            ->groupBy('invoice.invoice_number', 'invoice.client_id', 'invoice.created_at',  'invoice.equipment_serial_number', 'client.name', 'client.email', 'full_name')
            ->orderBy('created_at', 'desc')
            ->distinct()
            ->get();


        return response()->json([
        'invoice' => $invoices]);
    }


    public function store(Request $request)
    {
        try {

                $invoiceItem = new Invoice;
                $invoiceItem->invoice_number = $request->invoice_number;
                $invoiceItem->client_id = $request->client_id;
                $invoiceItem->equipment_serial_number = $request->equipment_serial_number;
                $invoiceItem->equipment = $request->equipment;
                $invoiceItem->quantity = $request->quantity;
                $invoiceItem->cost = $request->cost;
                $invoiceItem->created_binvoiced_byy = '4';
                $invoiceItem->save();

            return "success";
            // return redirect()->back()->with('success', 'Invoice added successfully!');
        } catch (\Exception $e) {
            // Redirect back with error message
            return "error";
            // return redirect()->back()->with('error', 'An error occurred while adding the invoice: ' . $e->getMessage());
        }
    }



}
