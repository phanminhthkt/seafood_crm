<?php
namespace App\Repositories\Status;

use App\Repositories\RepositoryInterface;

interface StatusRepositoryInterface extends RepositoryInterface
{
    public function getDataByCondition($request,$data);
}