<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
class InvoiceController extends Controller
{
    public function getInvoices(){
        $invoices = Invoice::query()->get();
        return $invoices;
    }

    public function store(Request $request){
        // $request->validate([
        //     'client_id' => 'string',
        //     'invoice_id' => 'string',
        //     'equipment_serial_number' => 'string',
        //     'equipment' => 'string',
        //     'quantity' => 'string',
        //     'cost' => 'string',

        // ]);

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pin = mt_rand(1000000, 9999999)
            . mt_rand(1000000, 9999999)
            . $characters[rand(0, strlen($characters) - 1)];
        $random_string = str_shuffle($pin);

        // $invoice = new Invoice();
        // $invoice->invoice_number = $random_string;
        // $invoice->client_id = $request->client_id;
        // $invoice->equipment_serial_number = $request->equipment_serial_number;
        // $invoice->equipment = $request->equipment;
        // $invoice->quantity = $request->quantity;
        // $invoice->cost = $request->cost;

        // $invoice->created_binvoiced_byy = auth()->id();
        // $invoice->save();

        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'New invoice successfully generated',
        //     'invoice' => $invoice,
        // ]);

        {
            // Validate the form data
            $validatedData = $request->validate([
                'equipments.*' => 'required',
                'quantities.*' => 'required|integer',
            ]);

            // Loop through the items and quantities and create new Item models
            foreach ($validatedData['equipments'] as $key => $item) {
                $quantity = $validatedData['quantities'][$key];
                $newItem = new Item;
                $newItem->name = $item;
                $newItem->quantity = $quantity;
                $newItem->save();
            }

            // Return a success response
            return response()->json(['message' => 'Form submitted successfully']);
        }

    }


}
