<?php
namespace App\Repositories\Attribute;

use App\Repositories\RepositoryInterface;

interface AttributeRepositoryInterface extends RepositoryInterface
{
    public function getDataByCondition($request,$data);
}