<?php
namespace App\Repositories\Category;

use App\Repositories\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function getDataByCondition($request,$data);
}