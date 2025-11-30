<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TicketAttachment extends Model
{
    use HasFactory;

    protected $table = '0_tkt_attachments';

    protected $fillable = [
        'ticket_id',
        'reply_id',
        'filename',
        'original_filename',
        'mime_type',
        'file_size',
        'path',
        'uploaded_by',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'tkt_id');
    }

    public function reply()
    {
        return $this->belongsTo(TicketReply::class);
    }

    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    // Get full URL for the attachment
    public function getUrlAttribute()
    {
        return Storage::url($this->path);
    }

    // Get human-readable file size
    public function getFormattedSizeAttribute()
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    // Check if file is an image
    public function isImage()
    {
        return in_array($this->mime_type, [
            'image/jpeg',
            'image/png',
            'image/gif',
            'image/webp',
            'image/svg+xml'
        ]);
    }
}