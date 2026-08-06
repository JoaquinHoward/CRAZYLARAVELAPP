<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
#[Fillable(['name', 'amount', 'date', 'category_id'])]
class Expense extends Model
{
    //
}
