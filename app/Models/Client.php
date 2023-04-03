<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Client extends Model
{
    use HasFactory;
    protected $table = 'client';
    public $fillable = ['client_id', 'name', 'phone_number', 'email', 'client_address', 'gender', 'marital_status', 'state_of_residence', 'nature_of_business', 'edi_id', 'registered_by'];

    /**
     * Get the user associated with the Client
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'registered_by');
    }
}
