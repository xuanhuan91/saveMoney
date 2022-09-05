<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class categoryExpense extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'parent_id'];

    public function sub_category(){
        return $this->hasMany(categoryExpense::class, 'parent_id');
    }
    public function self_category(){
        return $this->belongsTo(categoryExpense::class, 'parent_id');
    }
}
