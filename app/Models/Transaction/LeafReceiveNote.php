<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Model;

use App\Models\Master\Supplier;
use App\Models\Master\LeafCategory;

class LeafReceiveNote extends Model {

    protected $table = 'leaf_receive_note';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'lrn_date',
        'supplier_id',
        'lc_id',
        'price',
        'weight',
        'lrn_value',
        'lrn_balance',
        'remark',
        'cancel',
        'cancel_on',
        'cancel_remark',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [];

    protected $casts = [
        'lr_date' => 'date',
        'paid_on' => 'datetime',
        'cancel_on' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'price' => 'decimal:2',
        'weight' => 'decimal:3',
        'lrn_value' => 'decimal:2',
        'paid_value' => 'decimal:2',
        'cancel' => 'boolean',
    ];

    public function Supplier() {

        return $this->belongsTo(Supplier::class);
    }

    public function LeafCategory(){

        return $this->belongsTo(LeafCategory::class);
    }

}
