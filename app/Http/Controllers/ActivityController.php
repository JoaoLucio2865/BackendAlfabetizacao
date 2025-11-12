<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller {
    public function index() {
        return Activity::with('creator')->get();
    }

    public function store(Request $request) {
        if (auth()->user()->role !== 'admin') {
            return response()->json(['error' => 'Acesso negado'], 403);
        }    
        
        $request->validate([
            'title' => 'required|string',
            'type' => 'required|in:syllables,words,phrases',
            'items' => 'required|array',
            'level' => 'in:easy,medium,hard'
        ]);

        return Activity::create(array_merge($request->all(), ['created_by' => auth()->id()]));
    }

    public function show($id) {
        return Activity::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $activity = Activity::findOrFail($id);
        $activity->update($request->all());
        return $activity;
    }

    public function destroy($id) {
        Activity::findOrFail($id)->delete();
        return response()->json(['message' => 'Atividade deletada']);
    }
}