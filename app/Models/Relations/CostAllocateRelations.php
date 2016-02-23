<?php

namespace App\Models\Relations;

use App\Models\ItemOrder;
use Illuminate\Database\Eloquent\Model;

class CostAllocateRelations extends Model
{
    /**
     * CostAllocate can have many itemOrders.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function itemOrders(){
        return $this->hasMany(ItemOrder::class, 'cost_id');
    }
}
