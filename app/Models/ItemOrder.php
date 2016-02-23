<?php

namespace App\Models;

use App\Models\Relations\ItemOrderRelations;
use App\Models\Traits\MandanteTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemOrder extends ItemOrderRelations
{
    use SoftDeletes;
    use MandanteTrait;

    /**
     * Fillable fields for a Model.
     *
     * @var array
     */
    protected $fillable = [
//        'mandante',
//        'order_id',
//        'cost_id',
//        'product_id',
//        'currency_id',
//        'quantidade',
//        'valor_unitario',
//        'desconto_unitario',
//        'descricao',
    ];

}
