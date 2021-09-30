<?php

namespace App\Traits;
use App\Models\Product;
use DB;

trait WmsTrait {
    public function checkNumberInventory($request,$product_id) {
        $request->store = $request->store_from_id;
        $number = $this->fullQueryWareHouse($request)->where('id','=',$product_id)->pluck('total_quantity')->first();
        return $number;
    }
    public function subQueryWms($charTable,$store_id,$status_id){
      $querySub = DB::table('wms_'.$charTable.'_details')
          ->selectRaw('sum(IFNULL(product_quantity,0)) as '.$charTable.'_quantity,product_id as '.$charTable.'_product_id')
          ->groupBy('product_id')
          ->join('wms_'.$charTable.'s','wms_'.$charTable.'s.id','=','wms_'.$charTable.'_details.'.$charTable.'_id')
          ->where('wms_'.$charTable.'s.store_id','=',$store_id)
          ->where('wms_'.$charTable.'s.status_id','=',$status_id);
      return $querySub;
    }
    public function subQueryWmsTransfer($charTable,$store_id,$type='',$status_id){
      $querySub = DB::table('wms_'.$charTable.'_details')
          ->selectRaw('sum(IFNULL(product_quantity,0)) as '.$type.'_quantity,product_id as '.$type.'_product_id')
          ->groupBy('product_id')
          ->join('wms_'.$charTable.'s','wms_'.$charTable.'s.id','=','wms_'.$charTable.'_details.'.$charTable.'_id')
          ->where('wms_'.$charTable.'s.'.$type.'_id','=',$store_id)
          ->where('wms_'.$charTable.'s.status_id','=',$status_id);
      return $querySub;
    }
    public function queryProductNoParent(){
      $value = Product::select('name','id','export_price','import_price','unit_id','category_id','is_status','is_priority')
        ->withCount('children')
        ->with(['category:id,name','unit:id,name'])
        ->having('children_count','<',1);
      return $value;
    }
    public function fullQueryWareHouse($request,$status_id=3){
      $value = $this->queryProductNoParent()
          ->leftjoinSub($this->subQueryWms('export',$request->store,$status_id),'export_product_id',function($query){
            $query->on('products.id','=','export_product_id');
          })
          ->leftjoinSub($this->subQueryWms('import',$request->store,$status_id),'import_product_id',function($query){
            $query->on('products.id','=','import_product_id');
          })
          ->leftjoinSub($this->subQueryWmsTransfer('transfer',$request->store,'store_to',$status_id),'store_to_product_id',function($query){
            $query->on('products.id','=','store_to_product_id');
          })
          ->leftjoinSub($this->subQueryWmsTransfer('transfer',$request->store,'store_from',$status_id),'store_from_product_id',function($query){
            $query->on('products.id','=','store_from_product_id');
          })
          ->selectRaw('IFNULL(import_quantity,0) - IFNULL(export_quantity,0) + IFNULL(store_to_quantity,0) - IFNULL(store_from_quantity,0) as total_quantity');
      return $value;    
    }
}