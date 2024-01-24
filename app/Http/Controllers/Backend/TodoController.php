<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ToDo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        return view('backend.todo.index', compact('todos'));
    }

    public function store(Request $request)
    {
        Todo::create($request->all());
        return response()->json(['success' => 'Todo created successfully']);
    }

    public function edit($id)
    {
        $todo = ToDo::find($id);
        return response()->json($todo);
    }

    public function update(Request $request, $id)
    {
        Todo::find($id)->update($request->all());
        return response()->json(['success' => 'Todo updated successfully']);
    }

    public function destroy($id)
    {
        Todo::find($id)->delete();
        return response()->json(['success' => 'Todo deleted successfully']);
    }
}
