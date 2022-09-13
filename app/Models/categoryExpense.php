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

    public function subcategory()
    {
        return $this->hasMany(categoryExpense::class, 'subCategoryiD');
    }

    public function expenses()
    {
        return $this->hasMany(expense::class, 'categoryExpenseId');

    }
}
