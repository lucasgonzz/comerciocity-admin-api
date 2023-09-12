<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $guarded = [];

    function scopeWithAll($query) {
        $query->with('articles');
    } 

    public function discounts() {
        return $this->belongsToMany('App\Models\Discount')->withPivot('percentage');
    }

    public function surchages() {
        return $this->belongsToMany('App\Models\Surchage')->withPivot('percentage');
    }

    public function services() {
        return $this->belongsToMany('App\Models\Service')->withPivot('discount', 'amount', 'price');
    }

    public function combos() {
        return $this->belongsToMany('App\Models\Combo')->withPivot('amount', 'price',);
    }

    public function articles() {
        return $this->belongsToMany('App\Models\Article')->withPivot('amount', 'cost', 'price', 'returned_amount', 'delivered_amount', 'discount', 'with_dolar')->withTrashed();
    }
}
