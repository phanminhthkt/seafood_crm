<?php
namespace App\Repositories\Wms;

use App\Repositories\RepositoryInterface;

interface WmsRepositoryInterface extends RepositoryInterface
{
    public function getDataByCondition($request,$data);
}