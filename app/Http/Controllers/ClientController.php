<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;
class ClientController extends Controller
{
    // public function __construct(){
    //     $this->middleware('auth');
    // }

    public function searchClient(Request $request, $id)
    {
        $client = Client::where('phone_number', '=', $id)->orWhere('email', '=', $id)->orWhere('client_id', '=', $id)->first();

        if ($client) {
            return response()->json(['success' => true, 'client' => $client]);
        } else {
            return response()->json(['error' => 'Client not found.'], 404);
        }
    }

    public function store(Request $request){
        // $request->validate([
        //     'client_id' => 'string',
        //     'name' => 'string',
        //     'phone_number' => 'string',
        //     'email' => 'email',
        //     'contact_address' => 'string',
        //     'gender' => 'string',
        //     'marital_status' => 'string',
        //     'state_of_residence' => 'string',
        //     'nature_of_business' => 'string',
        //     'edi_id' => 'string',
        //     'referred_by'=>'string'
        // ]);

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pin = mt_rand(10000, 999999)
            . mt_rand(10000, 999999)
            . $characters[rand(0, strlen($characters) - 1)];
        $random_string = str_shuffle($pin);

        $client = new Client();
        $client->client_id = $random_string;
        $client->name = $request->name;
        $client->phone_number = $request->phone_number;
        $client->email = $request->email;
        $client->contact_address = $request->contact_address;
        $client->gender = $request->gender;
        $client->marital_status = $request->marital_status;
        $client->state_of_residence = $request->state_of_residence;
        $client->nature_of_business = $request->nature_of_business;
        $client->edi_id = $request->edi_id;
        $client->referred_by = $request->referred_by;
        // $client->registered_by = auth()->id();
        $client->save();

        return response()->json([
            'status' => 'success',
            'message' => 'New client successfully added',
            'clients' => [$client],
        ]);

    }

    public function fetchClients(){
        $clients = Client::query()
        ->orderBy('created_at', 'desc')
        ->with(['user' => function ($query) {$query->select('id', 'first_name', 'last_name');}])
        ->get();
        return $clients;
        // return response()->json([
        //      $clients
        // ]);
    }

    public function exportClientToPDF(Request $request, $id){
        $pdf = Client::find($id);
        return $pdf;
    }
}
