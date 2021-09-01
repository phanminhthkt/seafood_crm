<?php
namespace App\Repositories\Unit;

use App\Repositories\RepositoryInterface;

interface UnitRepositoryInterface extends RepositoryInterface
{
    public function getDataByCondition($request,$data);
}