<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model {
    protected $fillable = ['title', 'type', 'items', 'level', 'created_by'];

    protected $casts = ['items' => 'array'];

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function progresses() {
        return $this->hasMany(Progress::class);
    }
}