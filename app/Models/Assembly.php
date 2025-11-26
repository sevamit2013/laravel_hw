<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable; // Import Auditable Contract
use OwenIt\Auditing\Auditable as AuditableTrait; // Import Auditable Trait

class Assembly extends Model implements Auditable // Implement Auditable Contract
{
    use HasFactory, AuditableTrait; // Use Auditable Trait


    protected $table = '0_hw_assembly';
    protected $primaryKey = 'assembly_id';

    protected $fillable = [
        'assembly_code',
        'description',
        'ip_address',
        'loc_code',
        'user_id',
        'remark',
        'status',
        'created_by',
        'modified_by',
    ];
    protected $attributes = [
        'ip_address' => '0.0.0.0',
    ];
    public function location()
    {
        return $this->belongsTo(Location::class, 'loc_code', 'loc_code');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
