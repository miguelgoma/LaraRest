<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public function order()
    {
        return $this->belogsTo(Order::class);
    }
}
