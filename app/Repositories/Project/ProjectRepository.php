<?php
namespace App\Repositories\Project;

use App\Repositories\BaseRepository;

class ProjectRepository extends BaseRepository implements ProjectRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Project::class;
    }
    public function getDataByCondition($request,$pathType,$perpage){
    	$sql  = $this->_model::with(['dev','saler','status_project','status_code'])->where('id','<>', 0);
        if($request->has('term') && $request->term!=''){
            $sql->where('name', 'Like', '%' . $request->term . '%');
            $pathType .= '?term='.$request->term;
        }
        if($request->has('dev') && $request->dev!=''){
            $dev = $request->dev;
            $sql->whereHas('members', function ($query) use ($dev) {
                return $query->where([['members.id', '=', $dev],['members.group_id','=',1]]);
            });
            $pathType .= '?dev='.$request->dev;
        }
        if($request->has('saler') && $request->saler!=''){
            $saler = $request->saler;
            $sql->whereHas('members', function ($query) use ($saler) {
                $query->where('members.id', $saler)->where('members.group_id',2);
            });
            $pathType .= '?dev='.$request->dev;
        }
        if($request->has('status_code') && $request->status_code!=''){
            $status_code = $request->status_code;
            $sql->whereHas('status', function ($query) use ($status_code) {
                $query->where('status.id', $status_code)->where('status.group_id',1);
            });
            $pathType .= '?status_code='.$status_code;
        }
        if($request->has('status_project') && $request->status_project!=''){
            $status_project = $request->status_project;
            $sql->whereHas('status', function ($query) use ($status_project) {
                $query->where('status.id', $status_project)->where('status.group_id',2);
            });
            $pathType .= '?status_project='.$request->status_project;
        }
        $data = $sql->orderBy('id','desc')->paginate($perpage)->withPath(url()->current().$pathType);
        return $data;
    }

    public function createDataHasRelation($request){
    	$data = $request->except('_token');
        if($request->hasFile('file')){
            $this->validate($request,[
                    'file' => 'mimes:doc,docx,pdf,DOC,DOCX,PDF,xlsx,XLSX,xls,XLS|max:2048',],          
                [
                    'file.mimes' => 'Chỉ chấp nhận file đuôi doc,docx,pdf,DOC,DOCX,PDF,xlsx,XLSX,xls,XLS',
                    'file.max' => 'File giới hạn dung lượng không quá 2M',
                ]
            );
            $file = $request->file('file');
            $nameFile =  time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/files'),$nameFile);
            $data['file'] =  $nameFile;
        }

        $data['begin_at'] = formatDate($request->begin_at,'Y-m-d H:i:s');
        $data['ended_at'] = formatDate($request->ended_at,'Y-m-d H:i:s');
        $data['estimated_at'] = formatDate($request->estimated_at,'Y-m-d H:i:s');
        $data['received_at'] = formatDate($request->received_at,'Y-m-d H:i:s');
        $request->group_member = rejectNullArray($request->group_member);
        $request->group_status = rejectNullArray($request->group_status);

        if($projectId = $this->_model->create($data)->id){
            $project = $this->_model::find($projectId);
            $project->members()->attach($request->group_member); 
            $project->status()->attach($request->group_status); 
            return true;
        }else{
            return false;
        }
    }
    public function updateDataHasRelation($request,$id){
		$project = $this->_model->findOrFail($id);
        $data = $request->except('_token','_method','group_member','group_status');
        if($request->hasFile('file')){
            $this->validate($request,[
                    'file' => 'mimes:doc,docx,pdf,DOC,DOCX,PDF,xlsx,XLSX,xls,XLS|max:2048',],          
                [
                    'file.mimes' => 'Chỉ chấp nhận file đuôi doc,docx,pdf,DOC,DOCX,PDF,xlsx,XLSX,xls,XLS',
                    'file.max' => 'File giới hạn dung lượng không quá 2M',
                ]
            );
            if($project->file!=''){
                 File::delete(public_path('uploads/files/').$project->file);
            }
            $file = $request->file('file');
            $nameFile =  time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/files'),$nameFile);
            $data['file'] =  $nameFile;
        }
        
        $data['begin_at'] = formatDate($request->begin_at,'Y-m-d H:i:s');
        $data['ended_at'] = formatDate($request->ended_at,'Y-m-d H:i:s');
        $data['estimated_at'] = formatDate($request->estimated_at,'Y-m-d H:i:s');
        $data['received_at'] = formatDate($request->received_at,'Y-m-d H:i:s');
        $request->group_member = rejectNullArray($request->group_member);
        $request->group_status = rejectNullArray($request->group_status);

        if($project->where('id', $id)->update($data)){
            $project->members()->sync($request->group_member); 
            $project->status()->sync($request->group_status); 
            return true;
        }else{
            return false;
        }    	
    }
}