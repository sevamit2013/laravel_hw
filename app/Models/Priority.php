<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable; // Import Auditable Contract
use OwenIt\Auditing\Auditable as AuditableTrait; // Import Auditable Trait

class Priority extends Model implements Auditable // Implement Auditable Contract
{
    use HasFactory, AuditableTrait; // Use Auditable Trait

    protected $table = 'priorities';

    protected $fillable = [
        'name',
        'inactive',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
