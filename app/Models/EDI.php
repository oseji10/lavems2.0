<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EDI extends Model
{
    use HasFactory;
    protected $table = 'edi';
    public $fillable = ['edi_name', 'created_by'];
}
