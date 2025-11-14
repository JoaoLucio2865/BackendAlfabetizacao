<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model {
    protected $fillable = ['user_id', 'activity_id', 'score', 'completed_at', 'status', 'submission', 'feedback'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function activity() {
        return $this->belongsTo(Activity::class);
    }
}