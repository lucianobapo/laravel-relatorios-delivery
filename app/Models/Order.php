<?php

namespace App\Models;

use App\Models\Relations\OrderRelations;
use App\Models\Traits\MandanteTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends OrderRelations
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
//        'partner_id',
//        'address_id',
//        'currency_id',
//        'type_id',
//        'payment_id',
//        'posted_at',
//        'valor_total',
//        'desconto_total',
//        'troco',
//        'descricao',
//        'referencia',
//        'obsevacao'
    ];

    /**
     * Additional fields to treat as Carbon instances.
     *
     * @var array
     */
    public $dates = ['posted_at'];

    /**
     * Set the posted_at attribute.
     *
     * @param $date
     */
    public function setPostedAtAttribute($date) {
        $this->attributes['posted_at'] = Carbon::parse($date);
    }

    /**
     * Get the posted_at attribute.
     *
     * @return string
     */
    public function getPostedAtAttribute() {
        return Carbon::parse($this->attributes['posted_at'])->format('d/m/Y H:i');
    }

    /**
     * Get the posted_at attribute.
     *
     * @return string
     */
    public function getPostedAtCarbonAttribute() {
        return Carbon::parse($this->attributes['posted_at']);
    }

    /**
     * Ardent validation rules
     */
    public static $rules = array(
        'mandante' => 'required',
        'posted_at'      => 'required',
//        'partner_id' => 'required|numeric',
//        'slug' => 'required|alpha_dash',    // Post Url
//        'content' => 'required',            // Post content (Markdown)
//        'author_id' => 'required|numeric',  // Author id
    );


}
