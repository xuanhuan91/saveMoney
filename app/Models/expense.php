<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class expense extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table ="expenses";

    protected $dates = ['deleted_at'];

    public function categoryExpense()
    {
        return $this->belongsTo(categoryExpense::class, 'categoryExpenseId');
    }
}
