<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    
    protected $table = 'customers';

    protected $fillable = ['contact_number', 'status_code', 'is_whitelisted'];
}
