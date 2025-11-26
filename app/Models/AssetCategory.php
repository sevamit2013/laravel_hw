<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable; // Import Auditable Contract
use OwenIt\Auditing\Auditable as AuditableTrait; // Import Auditable Trait

class AssetCategory extends Model implements Auditable // Implement Auditable Contract
{
    use HasFactory, AuditableTrait; // Use Auditable Trait

    protected $table = '0_hw_stock_category';
    protected $primaryKey = 'category_id';

    protected $fillable = [
        'description',
        'is_software',
        'inactive',
    ];

    public function getRouteKeyName()
    {
        return 'category_id';
    }

    public function subCategories()
    {
        return $this->hasMany(AssetSubCategory::class);
    }

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }
}
