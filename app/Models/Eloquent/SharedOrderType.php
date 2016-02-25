<?php namespace App\Models\Eloquent;

use App\Models\Eloquent\Relations\SharedOrderTypeRelations;
use Illuminate\Database\Eloquent\SoftDeletes;

class SharedOrderType extends SharedOrderTypeRelations {

    use SoftDeletes;

    protected $fillable = [
//        'tipo',
//        'descricao',
    ];



}
