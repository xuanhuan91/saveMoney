<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class categoryIncome extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'parent_id'];

    public function subcategory()
    {
        return $this->hasMany(categoryIncome::class, 'subCategoryiD');
    }

    public function income()
    {
        return $this->hasMany(income::class, 'categoryIncomeId');
    }
//    public function
}
