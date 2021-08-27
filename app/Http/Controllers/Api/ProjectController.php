<?php

namespace App\Http\Controllers\Api;
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
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMember;
use Auth;

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

    public function __construct(Project $project)
    {
        Auth::shouldUse('members');
        $this->_model = $project;
        $this->_pathType = '';
        $this->_data['pageIndex'] = route('api.project.index');
        $this->_data['table'] = 'projects';
        $this->_data['devs'] = Member::where('group_id','=', 1)->get();
        $this->_data['sales'] = Member::where('group_id','=', 2)->get();
        $this->_data['status_codes'] = Status::where('group_id','=', 1)->get();
        $this->_data['status_projects'] = Status::where('group_id','=', 2)->get();
        $this->_data['title'] = 'Dự án';
        $this->_data['path_type'] = isset($_GET['type']) ? '?type='.$_GET['type']:'';
        $this->_data['column_dev'] = ["id","begin_at","estimated_at","ended_at","progress","link_end","link_end","link_host","note_end","note_host"];
        $this->_data['column_sale'] = ["id","name","link_design","contract_code","function","file","note"];
    }

    public function index(Request $request)
    {   
        $start_date = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->format('Y-m-d');
        $now_date = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->format('Y-m');
        $sql  = $this->_model::with(['dev','saler','status_project','status_code'])->where('id','<>', 0);
        if($request->has('time') && $request->time !== $now_date){
            $from_date = $request->time.'-01';
            $next_date = Carbon::parse($from_date)->addMonth()->format('Y-m-d');
            $sql->whereBetween('ended_at', array($from_date,$next_date));
        }else{
            $sql->where('ended_at','>', $start_date)->orWhere('ended_at','=', '');
        }
        // if($request->has('term')){
        //     $sql->where('name', 'Like', '%' . $request->term . '%');
        //     $this->_pathType .= '?term='.$request->term;
        // }
        if($request->has('term')){
            $sql->where('name', 'Like', '%' . $request->term . '%');
            $this->_pathType .= '?term='.$request->term;
        }
        if(Auth::guard('members')->user()->group_id !== ''){
            $member_group = Auth::guard('members')->user()->group_id;
            $sql->whereHas('members', function ($query) use ($member_group) {
                $query->where('members.id', $member_group)->where('members.group_id',$member_group);
            });
            $this->_pathType .= '?group='.$request->member_group;
        }
        if($request->has('status') && $request->status!=''){
            $status = $request->status;
            $sql->whereHas('status', function ($query) use ($status) {
                $query->where('status.id', $status);
            });
            $this->_pathType .= '?status='.$request->status;
        }
        $this->_data['items'] = $sql->orderBy('id','desc')->paginate(30)->withPath(url()->current().$this->_pathType);
        return response([
            $this->_data['items']
            // $this->_data
        ], 200);
        // return view('backend.project.index', $this->_data);
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
        $data = $request->except('_token');
        $data = $request->only($this->_data['column_sale']);
        $this->validate($request,
            [
                'name' => 'required',
                'contract_code' => 'required',
                'function' => 'required',
                'link_design' => 'required',
                'file' => 'required|mimes:doc,docx,pdf,DOC,DOCX,PDF,xlsx,XLSX,xls,XLS|max:2048'
            ],          
            [
                'name.required' => 'Vui lòng nhập tên dự án',
                'contract_code.required' => 'Vui lòng nhập mã hợp đồng',
                'function.required' => 'Vui lòng nhập chức năng',
                'link_design.required' => 'Vui lòng nhập link design',
                'file.required' => 'Vui lòng tải tải lên file đặc tả',
                'file.mimes' => 'Chỉ chấp nhận file đuôi doc,docx,pdf,DOC,DOCX,PDF,xlsx,XLSX,xls,XLS',
                'file.max' => 'File giới hạn dung lượng không quá 2M',
            ]
        );

        if($request->hasFile('file')){    
            $file = $request->file('file');
            $nameFile =  time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/files'),$nameFile);
            $data['file'] =  $nameFile;
        }
        $data['begin_at'] = formatDate($request->begin_at,'Y-m-d H:i:s');
        $data['ended_at'] = formatDate($request->ended_at,'Y-m-d H:i:s');
        $data['estimated_at'] = formatDate($request->estimated_at,'Y-m-d H:i:s');
        $data['received_at'] = formatDate($request->received_at,'Y-m-d H:i:s');
        if($projectId = $this->_model->create($data)->id){
            $project = $this->_model::find($projectId);
            $project->status()->attach([1,4]);
            $project->members()->attach([Auth::guard('members')->user()->id]); 
            return response()->json(
                [
                    'success' => 'Thêm dự án '. $request->name .' thành công'
                ],200
            );
        }else{
            return response()->json(
                [
                    'danger' => 'Thêm dự án '. $request->name .' thất bại.Xin vui lòng thử lại'
                ],500
            );
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
        $this->_data['item'] = $this->_model::with(['dev','saler','status_project','status_code'])->findOrFail($id);
        $this->_data['item']->begin_at = $this->_data['item']->begin_at != '' ? Carbon::parse($this->_data['item']->begin_at)->format('d-m-Y h:i:s A') : '';
        $this->_data['item']->estimated_at = $this->_data['item']->estimated_at != '' ? Carbon::parse($this->_data['item']->estimated_at)->format('d-m-Y h:i:s A') : '';
        $this->_data['item']->ended_at =$this->_data['item']->ended_at != '' ?  Carbon::parse($this->_data['item']->ended_at)->format('d-m-Y h:i:s A') : '';
        return response([
            $this->_data['item']
            // $this->_data
        ], 200);
    }
    public function editDev($id)
    {   
        $this->_data['item'] = $this->_model::select($this->_data['column_dev'])->with(['dev','saler','status_project','status_code'])->findOrFail($id);
        
        $this->_data['item']->begin_at = $this->_data['item']->begin_at != '' ? Carbon::parse($this->_data['item']->begin_at)->format('d-m-Y h:i:s A') : '';
        $this->_data['item']->estimated_at = $this->_data['item']->estimated_at != '' ? Carbon::parse($this->_data['item']->estimated_at)->format('d-m-Y h:i:s A') : '';
        $this->_data['item']->ended_at =$this->_data['item']->ended_at != '' ?  Carbon::parse($this->_data['item']->ended_at)->format('d-m-Y h:i:s A') : '';
        return response([
            $this->_data['item']
            // $this->_data
        ], 200);
    }

    public function updateDev(Request $request, $id)
    {
        $project = $this->_model->findOrFail($id);
        $data = $request->except('_token','_method');
        $data = $request->only($this->_data['column_dev']);
        $data['begin_at'] = formatDate($request->begin_at,'Y-m-d H:i:s');
        $data['ended_at'] = formatDate($request->ended_at,'Y-m-d H:i:s');
        $data['estimated_at'] = formatDate($request->estimated_at,'Y-m-d H:i:s');
        $data['received_at'] = formatDate($request->received_at,'Y-m-d H:i:s');
        $data['progress'] = $data['ended_at']!='' ? 100:$request->progress;
        if($project->where('id', $id)->update($data)){
            if($data['progress'] == 100) $project->status()->sync([3,4]);
            if($data['progress'] > 0 && $data['progress'] < 100) $project->status()->sync([2,4]);
            if($data['progress'] == 0) $project->status()->sync([1,4]);
            // $project->status()->sync([1,4]);
            return response()->json(
                [
                    'success' => 'Sửa dự án <strong>'. $request->name .'</strong> thành công'
                ],200
            ); 
        }else{
            return response()->json(
                [
                    'danger' => 'Sửa dự án <strong>'. $request->name .'</strong> thất bại.Xin vui lòng thử lại'
                ],500
            ); 
        }
    }


    public function editSale($id)
    {   

        $this->_data['item'] = $this->_model::select($this->_data['column_sale'])->with(['dev','saler','status_project','status_code'])->findOrFail($id);

        // Check sale owner project
        if($this->_data['item']->saler->first()->id != Auth::guard('members')->user()->id){
            return response()->json(
                [
                    'danger' => 'Dự án <strong>'. $request->name .'</strong> không thuộc quyền sở hữu của bạn'
                ],500
            ); 
        }

        $this->_data['item']->begin_at = $this->_data['item']->begin_at != '' ? Carbon::parse($this->_data['item']->begin_at)->format('d-m-Y h:i:s A') : '';
        $this->_data['item']->estimated_at = $this->_data['item']->estimated_at != '' ? Carbon::parse($this->_data['item']->estimated_at)->format('d-m-Y h:i:s A') : '';
        $this->_data['item']->ended_at =$this->_data['item']->ended_at != '' ?  Carbon::parse($this->_data['item']->ended_at)->format('d-m-Y h:i:s A') : '';
        return response([
            $this->_data['item']
            // $this->_data
        ], 200);
    }

    public function updateSale(Request $request, $id)
    {
        $project = $this->_model->findOrFail($id);
        // Check sale owner project
        if($project->saler->first()->id != Auth::guard('members')->user()->id){
            return response()->json(
                [
                    'danger' => 'Dự án <strong>'. $request->name .'</strong> không thuộc quyền sở hữu của bạn'
                ],500
            ); 
        }
        if ($request->has(['name', 'contract_code', 'function', 'link_design'])) {    
            $this->validate($request,
                [
                    'name' => 'required',
                    'contract_code' => 'required',
                    'function' => 'required',
                    'link_design' => 'required',
                ],          
                [
                    'name.required' => 'Vui lòng nhập tên dự án',
                    'contract_code.required' => 'Vui lòng nhập mã hợp đồng',
                    'function.required' => 'Vui lòng nhập chức năng',
                    'link_design.required' => 'Vui lòng nhập link design',
                ]
            );
        }
        if($request->hasFile('file')){
            $this->validate($request,
                [
                    'file' => 'required|mimes:doc,docx,pdf,DOC,DOCX,PDF,xlsx,XLSX,xls,XLS|max:2048'
                ],          
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
        
        $data = $request->except('_token','_method');
        $data = $request->only($this->_data['column_sale']);
        if($project->where('id', $id)->update($data)){
            return response()->json(
                [
                    'success' => 'Sửa dự án <strong>'. $request->name .'</strong> thành công'
                ],200
            ); 
        }else{
            return response()->json(
                [
                    'danger' => 'Sửa dự án <strong>'. $request->name .'</strong> thất bại.Xin vui lòng thử lại'
                ],500
            ); 
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /*
    public function update(Request $request, $id)
    {
        $project = $this->_model->findOrFail($id);
        $data = $request->except('_token','_method');

        if ($request->has(['name', 'contract_code', 'function', 'link_design'])) {    
            $this->validate($request,
                [
                    'name' => 'required',
                    'contract_code' => 'required',
                    'function' => 'required',
                    'link_design' => 'required',
                ],          
                [
                    'name.required' => 'Vui lòng nhập tên dự án',
                    'contract_code.required' => 'Vui lòng nhập mã hợp đồng',
                    'function.required' => 'Vui lòng nhập chức năng',
                    'link_design.required' => 'Vui lòng nhập link design',
                ]
            );
        }
        if($request->hasFile('file')){
            $this->validate($request,
                [
                    'file' => 'required|mimes:doc,docx,pdf,DOC,DOCX,PDF,xlsx,XLSX,xls,XLS|max:2048'
                ],          
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

        $data['progress'] = $data['ended_at']!='' ? 100:$request->progress;
        if($project->where('id', $id)->update($data)){
            if($data['progress'] == 100) $project->status()->sync([3,4]);
            if($data['progress'] > 0 && $data['progress'] < 100) $project->status()->sync([2,4]);
            if($data['progress'] == 0) $project->status()->sync([1,4]);
            // $project->status()->sync([1,4]);
            return response()->json(
                [
                    'success' => 'Sửa dự án <strong>'. $request->name .'</strong> thành công'
                ],200
            ); 
        }else{
            return response()->json(
                [
                    'danger' => 'Sửa dự án <strong>'. $request->name .'</strong> thất bại.Xin vui lòng thử lại'
                ],500
            ); 
        }
    }
    */
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function sendMailMember(Request $request,$id)
    {
        $project = $this->_model->findOrFail($id);
        Mail::to([$project->dev->first()->email,$project->saler->first()->email])->send(new SendMember($project));
        if (Mail::failures()) {
            return response()->json(
                [
                    'error' => 'Gửi mail không thành công'
                ],500
            );
        }else{
            return response()->json(
                [
                    'success' => 'Thông tin đã được gửi mail'
                ],200
            ); 
        }
    }
}
