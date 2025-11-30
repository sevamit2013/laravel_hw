<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Ticket extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $table = '0_tkt_header';
    protected $primaryKey = 'tkt_id';

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
        'due_date',
        'expected_time_hours',
        'actual_time_hours',
        'created_by',
        'modified_by',
        'is_closed',
        'is_reopen',
        'is_approved',
        'inactive',
        'unread_count',
    ];

    protected $casts = [
        'due_date' => 'date',
        'is_closed' => 'boolean',
        'is_reopen' => 'boolean',
        'is_approved' => 'boolean',
        'inactive' => 'boolean',
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
        return $this->hasMany(TicketReply::class, 'ticket_id', 'tkt_id')->orderBy('created_at', 'desc');
    }

    public function attachments()
    {
        return $this->hasMany(TicketAttachment::class, 'ticket_id', 'tkt_id');
    }

    // Check if ticket is late
    public function isLate()
    {
        return !$this->is_closed && $this->due_date < now();
    }

    // Increment unread count
    public function incrementUnreadCount()
    {
        $this->increment('unread_count');
    }

    // Reset unread count
    public function resetUnreadCount()
    {
        $this->update(['unread_count' => 0]);
    }
}