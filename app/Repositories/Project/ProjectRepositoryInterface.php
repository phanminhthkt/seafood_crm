<?php
namespace App\Repositories\Project;

use App\Repositories\RepositoryInterface;

interface ProjectRepositoryInterface extends RepositoryInterface
{
    // $pathType đường dẫn get.
    public function getDataByCondition($request,$pathType,$perpage);
    public function createDataHasRelation($request);
    public function updateDataHasRelation($request,$id);
}