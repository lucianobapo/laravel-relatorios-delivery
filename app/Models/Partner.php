<?php

namespace App\Models;

use App\Models\Relations\PartnerRelations;
use App\Models\Traits\GridSortingTrait;
use App\Models\Traits\MandanteTrait;
use App\Models\Traits\SyncItemsTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends PartnerRelations
{
    use SoftDeletes;
    use MandanteTrait;
//    use GridSortingTrait;
//    use SyncItemsTrait;

    /**
     * Fillable fields for a Model.
     *
     * @var array
     */
    protected $fillable = [
//        'mandante',
//        'user_id',
//        'nome',
//        'data_nascimento',
//        'observacao',
    ];

    /**
     * Additional fields to treat as Carbon instances.
     *
     * @var array
     */
    protected $dates = ['data_nascimento'];

    /**
     * Set the data_nascimento attribute.
     *
     * @param $date
     */
    public function setDataNascimentoAttribute($date) {
        $this->attributes['data_nascimento'] = Carbon::parse($date);
    }

    /**
     * Get the data_nascimento attribute.
     *
     * @return string
     */
    public function getDataNascimentoAttribute() {
        return Carbon::parse($this->attributes['data_nascimento'])->format('d/m/Y');
    }

}
