<?php 
use Carbon\Carbon;
function reOrderPermission($arr){
    $newArr=[];
    foreach ($arr as $k => $v) {
    	if($v['action']=='view'){
    		$newArr[0] = $v;
    	}elseif($v['action']=='create'){
    		$newArr[1] = $v;
    	}elseif($v['action']=='update'){
    		$newArr[2] = $v;
    	}elseif($v['action']=='delete'){
    		$newArr[3] = $v;
    	}
    }
    ksort($newArr);
    return $newArr;
}
function rejectNullArray($array){
    $array = array_filter($array,function($v){
        return $v!='';
    });
    return $array;
}
function formatDate($value,$format){
    $value = $value!= '' ? Carbon::parse($value)->format($format) : '';
    return $value;
}
function countByMonthYear($value,$year,$model){

    $value = $model::whereYear('created_at', '=', $year)->whereMonth('created_at','=', $value)->count();
    return $value;
}
function classStyleStatus($statusId,$type){
    if($type == 'button') $str = 'badge badge-';
    if($type == 'text') $str = 'text-';
    switch ($statusId) {
        case 1:
            $str.='danger';
            break;
        case 2:
            $str.='warning';
            break;
        case 3:
            $str.='success';
            break;
        case 4:
            $str.='warning';
            break;
        case 5:
            $str.='success';
            break;
        case 6:
            $str.='success';
            break; 
        case 7:
            $str.='warning';
            break;                 
        default:
            break;
    }
    return $str;
}