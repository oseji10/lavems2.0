<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoice';
    public $fillable = ['client_id', 'invoice_number', 'equpment_serial_number', 'equipment', 'quantity', 'cost', 'invoiced_by'];

    /**
     * Get the user associated with the Invoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client(): HasOne
    {
        return $this->hasOne(Client::class, 'client_id', 'id');
    }
}
