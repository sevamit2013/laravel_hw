<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable; // Import Auditable Contract
use OwenIt\Auditing\Auditable as AuditableTrait; // Import Auditable Trait

class Asset extends Model implements Auditable // Implement Auditable Contract
{
    use HasFactory, AuditableTrait; // Use Auditable Trait

    protected $table = '0_hw_assets';
    protected $primaryKey = 'asset_id';
    public $timestamps = false;

    protected $fillable = [
        'asset_code',
        'asset_description', // description -> asset_description
        'asset_category_id', // same
        'sub_category_id', // asset_sub_category_id -> sub_category_id
        'loc_code', // location_id -> loc_code
        'user', // user_id -> user
        'assembly_id', // same
        'manufacturer',
        'model',
        'company_serial',
        'purchase_date',
        'purchase_cost',
        'warranty_expiration_date',
        'remark',
        'status',
        'created_by',
        'modified_by',
    ];

    public function category()
    {
        return $this->belongsTo(AssetCategory::class, 'asset_category_id', 'category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(AssetSubCategory::class, 'sub_category_id', 'sub_cat_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'loc_code', 'loc_code');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }

    public function assembly()
    {
        return $this->belongsTo(Assembly::class, 'assembly_id', 'assembly_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
