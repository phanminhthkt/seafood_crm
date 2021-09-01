<?php
namespace App\Repositories\GroupAttribute;

use App\Repositories\RepositoryInterface;

interface GroupAttributeRepositoryInterface extends RepositoryInterface
{
    public function getDataByCondition($request,$data);
}