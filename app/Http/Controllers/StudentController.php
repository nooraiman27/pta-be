<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

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

    public function datatable()
    {
        $data = Student::latest()->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('checkbox', function($student) {
                $rowCheckbox = '<input type="checkbox" name="select-row[]" class="select-row" value="'.$student->id.'">';
                return $rowCheckbox;
            })
            ->addColumn('action', function($student) {
                $editRoute = route('student.edit', $student->id);
                $deleteRoute = route('student.destroy', $student->id);

                $actionBtn = '
                    <a href=" '.$editRoute.' " class="btn btn-warning">Update</a>
                    <form action=" '.$deleteRoute.' " method="POST" style="display:inline;">
                        '. csrf_field() .'
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'checkbox'])
            ->make(true);
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('select-row');
        if ($ids) {
            Student::whereIn('id', $ids)->delete();
            return redirect()->back()->with('success', 'Selected records have been deleted.');
        }
        return redirect()->back()->with('error', 'No record selected for deletion.');
    }

}
