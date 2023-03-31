<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
class ClientController extends Controller
{
    // public function __construct(){
    //     $this->middleware('auth');
    // }

    public function store(Request $request){
        $request->validate([
            'client_id' => 'string',
            'name' => 'string',
            'phone_number' => 'string',
            'email' => 'email',
            'contact_address' => 'string',
            'gender' => 'string',
            'marital_status' => 'string',
            'state_of_residence' => 'string',
            'nature_of_business' => 'string',
            'edi_id' => 'string'
        ]);

        $client = new Client();
        $client->client_id = $request->name;
        $client->name = $request->name;
        $client->phone_number = $request->phone_number;
        $client->email = $request->email;
        $client->contact_address = $request->contact_address;
        $client->gender = $request->gender;
        $client->marital_status = $request->marital_status;
        $client->state_of_residence = $request->state_of_residence;
        $client->nature_of_business = $request->nature_of_business;
        $client->edi_id = $request->edi_id;
        $client->registered_by = auth()->id();
        $client->save();

        return response()->json([
            'status' => 'success',
            'message' => 'New client successfully added',
            'client' => $client,
        ]);

    }

    public function fetchClients(){
        $clients = Client::all();
return $clients;
        // return response()->json([
        //      $clients
        // ]);
    }
}
