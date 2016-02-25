<?php

namespace App\Models\Eloquent;

use App\Models\Eloquent\Relations\CostAllocateRelations;
use App\Models\Eloquent\Traits\GridSortingTrait;
use App\Models\Eloquent\Traits\MandanteTrait;
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
