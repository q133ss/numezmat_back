<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    const waitPayment = 'Ожидает оплаты';
    const success = 'Завершен';
    const cancel = 'Отменен';
    const noPay = 'Не оплачен';

    public function getDate()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y H:i');
    }
}
