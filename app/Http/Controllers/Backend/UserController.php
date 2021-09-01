<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequestUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth;
use App\Models\User;
use App\Models\Role;
use Session;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $_data;
    private $_pathType;
    private $_repository;

    public function __construct(UserRepositoryInterface $userRepository,Role $role,Request $request)
    {

        $this->_repository = $userRepository;
        $this->_pathType = '';
        $this->_data['pageIndex'] = route('admin.user.index');
        $this->_data['table'] = 'users';
        $this->_data['roles'] = Role::get(['name','id']);
        //Load ajax if ajax-form,dev-form for add,edit.
        //Direct in if devform '' and ajaxForm=direct-form
        $this->_data['form'] = (object)['devform'=>'dev-form','ajaxform'=>'ajax-form'];
        $this->_data['title'] = 'Người dùng';
        $this->_data['type'] = $request->type;
        $this->_data['path_type'] = isset($_GET['type']) ? '?type='.$_GET['type']:'';
    }

    public function index(Request $request)
    {
        return view('backend.user.index', $this->_data);
    }
    public function getData(Request $request)
    {   
        return $this->_repository->getDataByCondition($request,Arr::except($this->_data, 'roles'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.user.add',$this->_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SignupRequestUser $request)
    {       
        $data = $request->except('_token','password_confirmation','role');
        $data['password'] = Hash::make($request->password);
        $data['remember_token'] = $request->_token;
        if($userId = $this->_repository->create($data)->id){
            $user = $this->_repository->findOrFail($userId);
            $user->roles()->attach($request->role);
            return redirect()->route('admin.user.index')->with('success', 'Thêm người dùng <b>'. $request->name .'</b> thành công');
        }else{
            return redirect()->route('admin.user.index')->with('danger', 'Thêm người dùng <b>'. $request->name .'</b> thất bại.Xin vui lòng thử lại');
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
        $this->_data['item'] = $this->_repository->findOrFail($id);
        $this->_data['role_array'] = [];
        foreach($this->_data['item']->roles as $v){array_push($this->_data['role_array'],$v['id']);}
        return view('backend.user.edit',$this->_data);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SignupRequestUser $request, $id)
    {
        $user = $this->_repository->findOrFail($id);
        $data = $request->except('_token','_method','password_confirmation','role');//# request only
        $data['password'] = Hash::make($request->password);
        $data['remember_token'] = $request->_token;
        if($this->_repository->update($id,$data)){
            $user->roles()->sync($request->role);
            return redirect()->route('admin.user.index')->with('success', 'Chỉnh sửa người dùng <b>'. $request->name .'</b> thành công');
        }else{
            return redirect()->route('admin.user.index')->with('danger', 'Chỉnh sửa người dùng <b>'. $request->name .'</b> thất bại.Xin vui lòng thử lại');
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
        if($this->_repository->delete($id)){
            return ['success' => true, 'message' => 'Xóa người dùng thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa người dùng thất bại.Xin vui lòng thử lại !!'];
        }
    }
    public function deleteMultiple($listId)
    {
        if($this->_repository->deleteMultiple($listId)){
            return ['success' => true, 'message' => 'Xóa người dùng thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa người dùng thất bại.Xin vui lòng thử lại !!'];
        }
    }

    public function getLogin()
    {

        session(['url.intended' => url()->previous()]);
        if(Auth::guard('web')->check() == true){
            return redirect()->intended(Session::get('url.intended'));
        }
        return view('backend.user.login');
    }
    public function postLogin(Request $request)
    {   
        session()->regenerate();
        $token = csrf_token();

        $credentials = $request->only('username', 'password');
        if (Auth::guard('web')->attempt($credentials)){
            //Check previout url
            $url_intended = (!session()->has('url.intended') || session('url.intended')===route('admin.user.login'))  ? route('admin.index') : session('url.intended');
            $noti = ['status' => 'true','msg' => 'Đăng nhập thành công','token' =>$token,'url_intended' => $url_intended]; 
            return response()->json($noti);
        }else{
            $noti = ['status' => 'false','msg' => 'Thông tin đăng nhập sai','token' =>$token]; 
            return response()->json($noti);
        }
    }
    public function logout(Request $request){
        Auth::guard('web')->logout();
        $request->session()->forget('loginAdmin');
        return redirect()->route('admin.user.login');
    }
}
