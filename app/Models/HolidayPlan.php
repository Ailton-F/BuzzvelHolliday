<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class HolidayPlan extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'title',
        'description',
        'date',
        'location',
    ];

    public function participants(){
        return $this->belongsToMany(User::class, 'holiday_plans_users');
    }
}
