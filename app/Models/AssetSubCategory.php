<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable; // Import Auditable Contract
use OwenIt\Auditing\Auditable as AuditableTrait; // Import Auditable Trait

class AssetSubCategory extends Model implements Auditable // Implement Auditable Contract
{
    use HasFactory, AuditableTrait; // Use Auditable Trait

    protected $table = '0_hw_sub_category';
    protected $primaryKey = 'sub_cat_id';

    protected $fillable = [
        'description',
        'asset_category_id',
        'inactive',
    ];

    public function getRouteKeyName()
    {
        return 'sub_cat_id';
    }

    public function category()
    {
        return $this->belongsTo(AssetCategory::class, 'asset_category_id');
    }

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }
}
