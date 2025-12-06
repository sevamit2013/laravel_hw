<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class TicketReply extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $table = '0_tkt_reply';
    protected $primaryKey = 'id'; // Adjust if your primary key is different

    protected $fillable = [
        'ticket_id',
        'description',
        'user_id',
        'unread',
        'inactive',
    ];

    protected $casts = [
        'unread' => 'boolean',
        'inactive' => 'boolean',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'tkt_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Add the missing attachments relationship
    public function attachments()
    {
        return $this->hasMany(TicketAttachment::class, 'reply_id', 'id');
    }
}