<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable; // Import Auditable Contract
use OwenIt\Auditing\Auditable as AuditableTrait; // Import Auditable Trait

class Ticket extends Model implements Auditable // Implement Auditable Contract
{
    use HasFactory, AuditableTrait; // Use Auditable Trait

    protected $table = '0_tkt_header';
    protected $primaryKey = 'tkt_id';

    const CREATED_AT = 'created_on';
    const UPDATED_AT = 'modified_on';

    protected $fillable = [
        'title',
        'description',
        'seeker_name',
        'priority_id',
        'type_id',
        'assign_id',
        'status_id',
        'asset_id',
        'assembly_id',
        'loc_code',
        'duedate',
        'created_by',
        'modified_by',
        'is_closed',
        'is_reopen',
        'is_approved',
        'inactive',
    ];

    public function getRouteKeyName()
    {
        return 'tkt_id';
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function ticket_type()
    {
        return $this->belongsTo(TicketType::class, 'type_id', 'type_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assign_id', 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function ticket_status()
    {
        return $this->belongsTo(TicketStatus::class, 'status_id', 'id');
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id', 'asset_id');
    }

    public function assembly()
    {
        return $this->belongsTo(Assembly::class, 'assembly_id', 'assembly_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'loc_code', 'loc_code');
    }

    public function replies()
    {
        return $this->hasMany(TicketReply::class);
    }
}
