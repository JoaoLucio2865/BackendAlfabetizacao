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
            'score' => 'required|integer|min:0|max:100',
            'submission' => 'nullable|string',  // Novo: Submissão do aluno
        ]);

        return Progress::create([
            'user_id' => auth()->id(),
            'activity_id' => $request->activity_id,
            'score' => $request->score,
            'submission' => $request->submission,
            'status' => 'pending',  // Padrão: aguardando validação
            'completed_at' => now()
        ]);
    }

    // Novo: Método para admins validarem progresso
    public function validateProgress(Request $request, $id) {
        if (auth()->user()->role !== 'admin') {
            return response()->json(['error' => 'Acesso negado'], 403);
        }
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'feedback' => 'nullable|string',
        ]);
        $progress = Progress::findOrFail($id);
        $progress->update([
            'status' => $request->status,
            'feedback' => $request->feedback,
        ]);
        return $progress;
    }
}