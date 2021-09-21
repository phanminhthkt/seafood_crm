<?php
namespace App\Repositories\Wms;

use App\Repositories\RepositoryInterface;

interface WmsExportRepositoryInterface extends RepositoryInterface
{
    public function getDataByCondition($request,$data);
    public function createHasRelation($request);
    public function updateHasRelation($request,$id);
}