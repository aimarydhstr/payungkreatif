<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeBase;
use Illuminate\Http\Request;

class KnowledgeBaseController extends Controller
{
    public function index()
    {
        $items = KnowledgeBase::latest()->get();
        return view('knowledge_bases.index', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'answer'   => 'required|string',
            'sources'  => 'nullable|string',
        ]);

        $knowledgeBase = KnowledgeBase::create($request->only('question','answer','sources'));

        if($knowledgeBase){
            return redirect()->back()->with('success', 'Data berhasil ditambahkan');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|string',
            'answer'   => 'required|string',
            'sources'  => 'nullable|string',
        ]);

        $knowledgeBase = KnowledgeBase::findOrFail($id);
        $knowledgeBase->update($request->only('question','answer','sources'));

        if($knowledgeBase){
            return redirect()->back()->with('success', 'Data berhasil diperbarui');
        }
    }

    public function destroy($id)
    {
        $knowledgeBase = KnowledgeBase::findOrFail($id);
        $knowledgeBase->delete();
        
        if($knowledgeBase){
            return redirect()->back()->with('success', 'Data berhasil diperbarui');
        }
    }
}
