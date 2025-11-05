<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Record;
use Illuminate\Validation\Rule;

class RecordsController extends Controller
{
    public function index()
    {
        $records = Record::orderBy('created_at', 'desc')->get();
        return view('admin.records', compact('records'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'nullable|integer|exists:users,id',
            'title' => 'required|string|max:255',
            'record_type' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'data' => 'nullable|array',
        ]);

        // allow JSON body (data) to be submitted as object
        if ($request->has('data') && is_string($request->input('data'))) {
            try {
                $data['data'] = json_decode($request->input('data'), true);
            } catch (\Throwable $e) {
                // ignore, validation will handle
            }
        }

        $record = Record::create($data + ['created_by' => auth()->id()]);

        return response()->json(['message' => 'Record created', 'data' => $record], Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $record = Record::findOrFail($id);
        return response()->json(['data' => $record]);
    }

    public function update(Request $request, $id)
    {
        $record = Record::findOrFail($id);

        $data = $request->validate([
            'user_id' => 'nullable|integer|exists:users,id',
            'title' => 'required|string|max:255',
            'record_type' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'data' => 'nullable|array',
        ]);

        if ($request->has('data') && is_string($request->input('data'))) {
            try { $data['data'] = json_decode($request->input('data'), true); } catch (\Throwable $e) {}
        }

        $record->update($data);
        return response()->json(['message' => 'Record updated', 'data' => $record]);
    }

    public function destroy($id)
    {
        $record = Record::findOrFail($id);
        $record->delete();
        return response()->json(['message' => 'Record deleted']);
    }
}
