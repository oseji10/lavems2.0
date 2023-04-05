<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubVendor extends Model
{
    use HasFactory;
    protected $table = 'subvendor';
    public $fillable = ['client_id', 'invoice_number', 'account_name', 'account_number', 'bank', 'amount', 'amount_payable', 'commission', 'remarks'];

}
