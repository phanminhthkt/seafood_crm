<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function updateStatus(Request $request){
    	$kind = DB::table($request->table)->where('id',$request->id)->value($request->kind);
    	DB::table($request->table)->where('id',$request->id)->update(
    		[$request->kind =>$kind ==1 ? 0 : 1]
    	);
    }
    public function updatePriority(Request $request){
    	DB::table($request->table)->where('id',$request->id)->update(
    		['is_priority' =>$request->value]
    	);
    }
}
