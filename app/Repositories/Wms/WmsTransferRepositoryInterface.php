<?php
namespace App\Repositories\Wms;

use App\Repositories\RepositoryInterface;

interface WmsTransferRepositoryInterface extends RepositoryInterface
{
    public function getDataByCondition($request,$data);
    public function createHasRelation($request);
    public function updateHasRelation($request,$id);
}