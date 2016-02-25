<?php

namespace App\ModelLayer\Repositories;

/**
 * Interface OrderRepositoryInterface
 * @package namespace App\ModelLayer\Repositories;
 */
interface OrderRepositoryInterface extends BaseRepositoryInterface
{
    public function collectionOrdersItemsCosts();
}
