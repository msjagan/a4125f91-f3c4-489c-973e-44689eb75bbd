<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;

class Account extends Model
{
    use HasFactory;

    protected $table = "accounts";
    protected $fillable = ['balance'];

    public function payments()
    {
      return $this->hasMany(Payment::class, 'account', 'id');
    }

    
}
