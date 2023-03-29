<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Inertia\Inertia;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Notes/List', [
            'notes' => Note::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Notes/Form', [
            'isEdit' => false,
            'formTitle' => 'Create Note'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Note::create(
            $request->validate([
                'title' => ['required', 'max:50'],
                'description' => ['required', 'max:400']
            ])
        );
        return to_route('notes.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        return Inertia::render('Notes/Form', [
            'isEdit' => true,
            'formTitle' => 'Edit Note',
            'note' => $note
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $note->update(
            $request->validate([
                'title' => ['required', 'max:50'],
                'description' => ['required', 'max:400']
            ])
        );
        return to_route('notes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note->delete();
    }
}
