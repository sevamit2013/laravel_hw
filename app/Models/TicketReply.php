<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable; // Import Auditable Contract
use OwenIt\Auditing\Auditable as AuditableTrait; // Import Auditable Trait

class TicketReply extends Model implements Auditable // Implement Auditable Contract
{
    use HasFactory, AuditableTrait; // Use Auditable Trait

    protected $table = '0_tkt_reply';

    protected $fillable = [
        'ticket_id',
        'description',
        'user_id',
        'unread',
        'inactive',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
