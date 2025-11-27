<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanCart extends Model
{
    protected $fillable = ['vehicle_id','user_id','duration_days','total_amount','status'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function vehicle() {
        return $this->belongsTo(Vehicle::class);
    }
}
