<?php
namespace App\Repositories\GroupStatus;

use App\Repositories\RepositoryInterface;

interface GroupStatusRepositoryInterface extends RepositoryInterface
{
    public function getDataByCondition($request,$data);
}