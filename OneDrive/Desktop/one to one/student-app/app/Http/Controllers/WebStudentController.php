<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class WebStudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', ['students' => $students]);
    }

    // Display the form to create a new student
    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        // Validate your request here if needed

        $student = Student::create([
            'name' => $request->name,
            'age' => $request->age,
            'address' => $request->address
        ]);

        $student->academic()->create([
            'course' => $request->input('academic.course'),
            'year' => $request->input('academic.year')
        ]);

        $student->country()->create([
            'continent' => $request->input('country.continent'),
            'name' => $request->input('country.name'),
            'capital' => $request->input('country.capital'),
        ]);

        return redirect('students')->with('message', 'Added Successfully');
    }

    public function edit($student_id)
    {
        $student = Student::findOrFail($student_id);
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        // Validate your request here if needed

        $student->update([
            'name' => $request->name,
            'age' => $request->age,
            'address' => $request->address
        ]);

        // Update associated models if needed:
        if ($request->has('academic')) {
            $student->academic()->updateOrCreate([], $request->get('academic'));
        }
        if ($request->has('country')) {
            $student->country()->updateOrCreate([], $request->get('country'));
        }

        return redirect('students')->with('message', 'Updated Successfully');
    }

    public function destroy(Student $student)
    {
        $student->academic()->delete();
        $student->country()->delete();
        $student->delete();
        return redirect('students')->with('message', 'Deleted Successfully');
    }
}
