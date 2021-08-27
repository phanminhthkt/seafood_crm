<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\File; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Status;
use App\Models\Project;
use App\Models\GroupMember;
use App\Models\GroupStatus;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMember;
use App\Repositories\Project\ProjectRepositoryInterface;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $_data;
    private $_pathType;
    private $_model;
    private $_repo;

    public function __construct(Project $project,ProjectRepositoryInterface $projectRepo)
    {
        $this->_repo = $projectRepo;
        $this->_model = $project;
        $this->_pathType = '';
        $this->_data['pageIndex'] = route('admin.project.index');
        $this->_data['table'] = 'projects';
        $this->_data['devs'] = Member::where('group_id','=', 1)->get();
        $this->_data['sales'] = Member::where('group_id','=', 2)->get();
        $this->_data['status_codes'] = Status::where('group_id','=', 1)->get();
        $this->_data['status_projects'] = Status::where('group_id','=', 2)->get();
        $this->_data['title'] = 'Dự án';
        $this->_data['path_type'] = isset($_GET['type']) ? '?type='.$_GET['type']:'';
    }

    public function index(Request $request)
    {
        $this->_data['items'] = $this->_repo->getDataByCondition($request,$this->_pathType,10);
        return view('backend.project.index', $this->_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.project.add',$this->_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($this->_repo->createDataHasRelation($request)){
            return redirect()->route('admin.project.index',['type' => $request->type])->with('success', 'Thêm dự án <b>'. $request->name .'</b> thành công');
        }else{
            return redirect()->route('admin.project.index',['type' => $request->type])->with('danger', 'Thêm dự án <b>'. $request->name .'</b> thất bại.Xin vui lòng thử lại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->_data['item'] = $this->_model->findOrFail($id);
        return view('backend.project.edit',$this->_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($this->_repo->updateDataHasRelation($request,$id)){
            return redirect()->route('admin.project.index',['type' => $request->type])->with('success', 'Sửa dự án <b>'. $request->name .'</b> thành công');
        }else{
            return redirect()->route('admin.project.index',['type' => $request->type])->with('danger', 'Sửa dự án <b>'. $request->name .'</b> thất bại.Xin vui lòng thử lại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data = $this->_model->findOrFail($id);
        if($data->file!=''){
            File::delete(public_path('uploads/files/').$data->file);
        }
        if($this->_model->where('id', $id)->delete()){
            // $data->members()->detach();//Có thể ko cần xài nếu đã build cascade on delete
            // $data->status()->detach();
            return ['success' => true, 'message' => 'Xóa dự án thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa dự án thất bại.Xin vui lòng thử lại !!'];
        }
    }
    public function deleteMultiple($listId)
    {
        $dataFile = $this->_model->whereIn('id',explode(",",$listId))->where('file','<>','')->pluck('file');
        foreach($dataFile as $file){
            if(File::exists(public_path('uploads/files/').$file)) {
                File::delete(public_path('uploads/files/').$file);
            }
        } 
        if($this->_model->whereIn('id',explode(",",$listId))->delete()){
            // DB::table('member_project')->whereIn('project_id',explode(",",$listId))->delete();
            // DB::table('project_status')->whereIn('project_id',explode(",",$listId))->delete();
            return ['success' => true, 'message' => 'Xóa dự án thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa dự án thất bại.Xin vui lòng thử lại !!'];
        }
    }
    public function sendMailMember(Request $request,$id)
    {
        $token = csrf_token();
        
        $project = $this->_model->findOrFail($id);
        Mail::to([$project->dev->first()->email,$project->saler->first()->email])->send(new SendMember($project));
        if (Mail::failures()) {
            $noti = ['status' => 'false','msg' => 'Gửi mail thất bại','token' =>$token];
            return response()->json($noti);
        }else{
            $noti = ['status' => 'true','msg' => 'Gửi mail thành công','token' =>$token];
            return response()->json($noti);
        }
    }
}
