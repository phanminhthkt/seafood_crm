<?php
namespace App\Repositories\Customer;

use App\Repositories\RepositoryInterface;

interface CustomerRepositoryInterface extends RepositoryInterface
{
    public function getDataByCondition($request,$data);
    public function getDataOrders($id,$data);
}