<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    //
    protected $table = "type_products";

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product(){
        //1 product type has 1 product  - 1-1 => has many
        return $this->hasMany('App\Product','id_type','id');


    }
    // 1 sản phẩm sẽ có nhiều chi tiết hóa đơn
    public  function bill_Detail(){
        return $this->hasMany('App\BillDetail','id_product','id');
    }
}
