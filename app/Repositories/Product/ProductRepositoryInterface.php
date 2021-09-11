<?php
namespace App\Repositories\Product;

use App\Repositories\RepositoryInterface;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function getDataByCondition($request,$data);
    public function getDataChildByCondition($id,$request,$data);
}