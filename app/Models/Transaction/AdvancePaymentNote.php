<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Model;

use App\Models\Master\Supplier;

class AdvancePaymentNote extends Model {

    protected $table = 'advance_payment_note';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'ap_date',
        'supplier_id',
        'value',
        'remark',
        'cancel',
        'cancel_on',
        'cancel_remark',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'ap_date' => 'date',
        'cancel_on' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function Supplier(){

        return $this->belongsTo(Supplier::class);
    }

}
