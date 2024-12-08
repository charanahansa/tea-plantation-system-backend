<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class LeafCategory extends Model {

    protected $table = 'leaf_category';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'lf_name',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean', // Cast `active` as a boolean (0 or 1)
    ];

}
