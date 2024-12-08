<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model {

    protected $table = 'supplier';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $fillable = [
        'supplier_name',
        'contact_no',
        'email',
        'address',
        'active',
        'created_at',
        'updated_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;

}
