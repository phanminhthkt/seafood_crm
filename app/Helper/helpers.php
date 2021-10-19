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
function revenueByTime($day,$date,$year,$model,$status){

    $value = $model::where('status_id','=',$status);
    if($year) $value = $value->whereYear('export_created_at', '=', $year);
    if($date) $value = $value->whereMonth('export_created_at','=', $date);
    if($day && $day < 10){ $day = '0'.$day; }
    if($day) $value = $value->whereDay('export_created_at', '=', $day);
    
    $value = $value->get(['total_price','ship_price','reduce_price'])->sum(function($val){ 
                                return ($val->total_price + $val->ship_price - $val->reduce_price); 
                            });
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

function generateFile($file,$path){
    $photo = $file;
    $pathPhoto =  Str::slug(time().'_'.pathinfo($photo->getClientOriginalName(),PATHINFO_FILENAME),'_').'.'.pathinfo($photo->getClientOriginalName(),PATHINFO_EXTENSION);
    $photo->move(public_path('uploads/products'),$pathPhoto);
    return $pathPhoto;
}