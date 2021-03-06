<?php

namespace App\Models\Eloquent\Relations;

use App\Models\Eloquent\Order;
use Illuminate\Database\Eloquent\Model;

class SharedOrderTypeRelations extends Model
{
    /**
     * SharedOrderType can have many orders.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders(){
        return $this->hasMany(Order::class,'type_id');
    }
}
