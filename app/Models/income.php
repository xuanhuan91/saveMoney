<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class income extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function categoryIncome()
    {
        return $this->belongsTo(categoryIncome::class, 'categoryIncomeId');
    }

    public function User()
    {
        return $this->belongsTo('App\Models\User','userId');
    }
}
