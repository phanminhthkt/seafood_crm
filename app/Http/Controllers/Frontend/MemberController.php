<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Member;//user model can kiem tra
use App\Models\GroupMember;
use Illuminate\Support\Str;
use Auth; //use thư viện auth
use Session;


class MemberController extends Controller
{
    private $_data;
    private $_pathType;
    private $_model;

    public function __construct(Member $member,Request $request)
    {
        $this->_model = $member;
        $this->_pathType = '';
        $this->_data['pageIndex'] = route('client.member.login');
        $this->_data['table'] = 'members';
        $this->_data['groups'] = GroupMember::all();
        $this->_data['title'] = 'thông tin';
        $this->_data['type'] = $request->type;
        $this->_data['path_type'] = isset($_GET['type']) ? '?type='.$_GET['type']:'';
    }

    public function index(Request $request)
    {

        $sql  = Member::with(['group'])->where('type',$request->type);
        $this->_pathType = '?type='.$request->type;
        if($request->has('term')){
            $sql->where('name', 'Like', '%' . $request->term . '%');
            $this->_pathType .= '&term='.$request->term;
        }
        $this->_data['items'] = $sql->orderBy('id','desc')->paginate(10)->withPath(url()->current().$this->_pathType);
        return view('frontend.member.index', $this->_data);
    }

    public function create()
    {
        return view('frontend.member.add',$this->_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

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
        return view('frontend.member.edit',$this->_data);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SignupRequest $request, $id)
    {
        $this->_model->findOrFail($id);
        
        $data = $request->except('_token','_method','password_confirmation');//# request only
        $data['password'] = Hash::make($request->password);
        $data['remember_token'] = $request->_token;
        if($this->_model->where('id', $id)->update($data)){
            return redirect()->route('client.member.edit',$id)->with('success', 'Chỉnh sửa thành viên <b>'. $request->name .'</b> thành công');
        }else{
            return redirect()->route('client.member.edit',$id)->with('danger', 'Chỉnh sửa thành viên <b>'. $request->name .'</b> thất bại.Xin vui lòng thử lại');
        }
    }

    public function getLogin()
    {
        session(['url.intended' => url()->previous()]);
        if(Auth::guard('members')->check() == true){
            return redirect()->intended(Session::get('url.intended'));
        }
        return view('frontend.member.login');//return ra trang login để đăng nhập
    }

    public function postLogin(Request $request)
    {
        $credentials  = [
            'email' =>[ 'email' => $request->email,'password' => $request->password],
            'user' =>[ 'username' => $request->email,'password' => $request->password]
        ];
        $remember = $request->remember == trans('remember.Remember Me') ? true : false;
        

        if (Auth::guard('members')->attempt($credentials['email']) || Auth::guard('members')->attempt($credentials['user'])){
            $user = Auth::guard('members')->user();
            if(Session::has('loginMember')){Session::forget('loginMember');}
            if($user->is_status == 0){
                Auth::guard('members')->logout();
                return redirect()->route('client.member.login')->with('danger', 'Tài khoản chưa kích hoạt');
            }
            $group = GroupMember::find($user->group_id);

            //Pusu perission to array
            $groupPermission = [];
            foreach($group->roles as $role){
                foreach($role->permissions as $k => $permission){
                    $groupPermission[$k] = (object)[
                        'module' => $permission->module,
                        'action' => $permission->action
                    ];
                }
            }
            session::put('loginMember',(object)[
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'name' => $user->name,
                'is_login' => true,
                'role' => $group->roles[0]->slug,
                'permission' => $groupPermission,
            ]);
            return redirect()->route('client.index');
        }else{
            return redirect()->route('client.member.login')->with('danger', 'Thông tin đăng nhập sai');
        }
    }
    public function getRegister()
    {
        session(['url.intended' => url()->previous()]);
        if(Auth::guard('members')->check() == true){
            return redirect()->intended(Session::get('url.intended'));
        }
        $data['groups'] = GroupMember::all();
        return view('frontend.member.register', $data);
    }
    public function postRegister(SignupRequest $request)
    {   
        $data = $request->except('_token','password_confirmation');
        $data['password'] = Hash::make($request->password);
        $data['remember_token'] = $request->_token;

        if($this->_model->create($data)){
            return redirect()->route('client.member.login')->with('success', htmlspecialchars('Thêm thành viên '. $request->name .' thành công'));
        }else{
            return redirect()->route('client.member.login')->with('danger', htmlspecialchars('Thêm thành viên '. $request->name .' thất bại.Xin vui lòng thử lại'));
        }
    }

    public function logout(Request $request){
        Auth::guard('members')->logout();
        $request->session()->forget('loginMember');
        return redirect()->route('client.member.login');
    }
}
