<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use Illuminate\Http\Request;

class ProgressController extends Controller {
    public function index() {
        return Progress::where('user_id', auth()->id())->with('activity')->get();
    }

    public function store(Request $request) {
        $request->validate([
            'activity_id' => 'required|exists:activities,id',
            'score' => 'required|integer|min:0|max:100'
        ]);

        return Progress::create([
            'user_id' => auth()->id(),
            'activity_id' => $request->activity_id,
            'score' => $request->score,
            'completed_at' => now()
        ]);
    }
}