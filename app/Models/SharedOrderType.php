<?php namespace App\Models;

use App\Models\Relations\SharedOrderTypeRelations;
use Illuminate\Database\Eloquent\SoftDeletes;

class SharedOrderType extends SharedOrderTypeRelations {

    use SoftDeletes;

    protected $fillable = [
//        'tipo',
//        'descricao',
    ];



}
