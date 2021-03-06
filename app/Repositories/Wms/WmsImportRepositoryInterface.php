<?php
namespace App\Repositories\Wms;

use App\Repositories\RepositoryInterface;

interface WmsImportRepositoryInterface extends RepositoryInterface
{
    public function getDataByCondition($request,$data);
    public function createHasRelation($request);
    public function updateHasRelation($request,$id);
}