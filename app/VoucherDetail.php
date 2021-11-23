<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoucherDetail extends Model
{
    public function voucher(){
        return $this->belongsTo(Voucher::class,'voucher_id','id');
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function subAccount(){
        return $this->belongsTo(SubAccount::class,'sub_account_id','id');
    }
}
