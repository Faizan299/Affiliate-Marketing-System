<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'start_date', 'end_date', 'start_time', 'end_time', 'venue', 'club_id', 'description', 'color', 'image'];

    // Define the relationship with Club model
    public function club()
    {
        return $this->belongsTo(Club::class);
    }
    public function attendees()
    {
        return $this->belongsToMany(User::class, 'event_attendees', 'event_id', 'student_id');
    }
    public function coordinator()
    {
        return $this->belongsTo(User::class, 'coordinator_id');
    }

    
}
