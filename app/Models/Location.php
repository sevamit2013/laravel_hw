<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable; // Import Auditable Contract
use OwenIt\Auditing\Auditable as AuditableTrait; // Import Auditable Trait

class Location extends Model implements Auditable // Implement Auditable Contract
{
    use HasFactory, AuditableTrait; // Use Auditable Trait


    protected $table = '0_seva_locations';
    protected $primaryKey = 'loc_code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'loc_code',
        'location_name',
        'parent_id',
        'inactive',
    ];

    // Configure auditing to handle string primary key
    public function transformAudit(array $data): array
    {
        // Cast the auditable_id to string for this model
        $data['auditable_id'] = (string) $data['auditable_id'];
        return $data;
    }

    public function getRouteKeyName(): string
    {
        return 'loc_code';
    }

    public function assemblies()
    {
        return $this->hasMany(Assembly::class);
    }

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function parent()
    {
        return $this->belongsTo(Location::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Location::class, 'parent_id');
    }
}
