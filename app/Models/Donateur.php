<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Donateur extends Model
{
    use HasFactory;

    protected $guarded=[];

    // public static function boot()
    // {
    //     parent::boot();

    //     self::creating(function($model){
    //         $model->user_id = Auth::user()->id;
    //     });
    //     self::updating(function($model){
    //         $model->user_id = Auth::user()->id;
    //     });
    // }
}
