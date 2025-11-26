<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable; // Import Auditable Contract
use OwenIt\Auditing\Auditable as AuditableTrait; // Import Auditable Trait

class Role extends Model implements Auditable // Implement Auditable Contract
{
    use AuditableTrait; // Use Auditable Trait
    protected $fillable = ['name', 'slug'];


    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
