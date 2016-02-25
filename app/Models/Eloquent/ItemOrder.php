<?php

namespace App\Models\Eloquent;

use App\Models\Eloquent\Relations\ItemOrderRelations;
use App\Models\Eloquent\Traits\MandanteTrait;
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
