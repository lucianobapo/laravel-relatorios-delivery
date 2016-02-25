<?php

namespace App\Models\Eloquent\Relations;

use App\Models\Eloquent\ItemOrder;
use App\Models\Eloquent\Partner;
use App\Models\Eloquent\SharedOrderType;
use Illuminate\Database\Eloquent\Model;

class OrderRelations extends Model
{
    /**
     * An Order belongs to a Partner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner() {
        return $this->belongsTo(Partner::class);
    }

    /**
     * An Order belongs to a Address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address() {
//        return $this->belongsTo(App\Models\Address::class);
    }

    /**
     * An Order belongs to a SharedCurrency.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency() {
//        return $this->belongsTo(App\Models\SharedCurrency::class);
    }

    /**
     * An Order belongs to an Order Type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type() {
        return $this->belongsTo(SharedOrderType::class,'type_id');
    }

    /**
     * An Order belongs to an Order Payment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payment() {
//        return $this->belongsTo(App\Models\SharedOrderPayment::class,'payment_id');
    }


    /**
     * Get the status associated with the given order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function status() {
//        return $this->belongsToMany(App\Models\SharedStat::class)->withTimestamps();
    }

    /**
     * Order can have many items.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems(){
        return $this->hasMany(ItemOrder::class);
    }

    /**
     * Order can have many confirmations.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function confirmations(){
//        return $this->hasMany(App\Models\OrderConfirmation::class);
    }

    /**
     * Order can have many attachments.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attachments(){
//        return $this->hasMany(App\Models\Attachment::class);
    }

}
