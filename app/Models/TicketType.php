<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable; // Import Auditable Contract
use OwenIt\Auditing\Auditable as AuditableTrait; // Import Auditable Trait

class TicketType extends Model implements Auditable // Implement Auditable Contract
{
    use HasFactory, AuditableTrait; // Use Auditable Trait

    protected $table = '0_tkt_types';
    protected $primaryKey = 'type_id';

    protected $fillable = [
        'name',
        'inactive',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
