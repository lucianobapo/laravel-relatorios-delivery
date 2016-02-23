<?php

namespace App\Models;

use App\Models\Relations\CostAllocateRelations;
use App\Models\Traits\GridSortingTrait;
use App\Models\Traits\MandanteTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class CostAllocate extends CostAllocateRelations
{
    use SoftDeletes;
    use MandanteTrait;
//    use GridSortingTrait;

    /**
     * Fillable fields for a Model.
     *
     * @var array
     */
    protected $fillable = [
//        'mandante',
//        'nome',
//        'numero',
//        'descricao',
    ];


}
