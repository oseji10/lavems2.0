<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'client';
    public $fillable = ['client_id', 'name', 'phone_number', 'email', 'client_address', 'gender', 'marital_status', 'state_of_residence', 'nature_of_business', 'edi_id', 'registered_by'];
}
