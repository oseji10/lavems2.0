<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoice';
    public $fillable = ['client_id', 'invoice_number', 'equpment_serial_number', 'equipment', 'quantity', 'cost', 'invoiced_by'];
}
