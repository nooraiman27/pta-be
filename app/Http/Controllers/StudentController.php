<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('students.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'email'         => 'required|email',
            'phone'         => 'required',
        ]);
        Student::create($request->all());

        return redirect()
            ->route('student.index')
            ->with('success', 'Record added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('students.form', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name'          => 'required',
            'email'         => 'required|email',
            'phone'         => 'required',
        ]);
        $student->update($request->all());

        return redirect()
            ->route('student.index')
            ->with('success', 'Record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()
            ->route('student.index')
            ->with('success', 'Record deleted successfully');
    }
}
