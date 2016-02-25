<?php

namespace App\Models\Doctrine\Repositories;

use App\ModelLayer\Repositories\OrderRepositoryInterface;

/**
 * Class OrderRepositoryDoctrine
 * @package namespace App\Models\Doctrine\Repositories;
 */
class OrderRepositoryDoctrine extends BaseEntityRepository implements OrderRepositoryInterface
{
    /**
     * @var array
     */
    protected $fillable = ['mandante'];

    public function collectionOrdersItemsCosts()
    {
//        return $this->model->with('orderItems','orderItems.cost')->get();

    }

}
