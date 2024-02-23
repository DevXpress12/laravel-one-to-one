<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class ApiStudentController extends Controller
{
    /**
     * Display a listing of students (with their related data).
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::with('academic', 'country')->get();
        return response()->json($students);
    }

    /**
     * Store a newly created student record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate your request here if needed

        $student = Student::create([
            'name' => $request->name,
            'age' => $request->age,
            'address' => $request->address
        ]);

        $academicData = $request->input('academic');
        $countryData = $request->input('country');

        $student->academic()->create([
            'course' => $academicData['course'],
            'year' => $academicData['year']
        ]);

        $student->country()->create([
            'continent' => $countryData['continent'],
            'name' => $countryData['name'],
            'capital' => $countryData['capital'],
        ]);

        // Load relationships for the response:
        $student->load('academic', 'country'); 

        return response()->json($student, 201); // Created
    }
    /**
     * Display the specified student record.
     *
     * @param  \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $student->load('academic', 'country'); // Eager-load relationship 
        return response()->json($student);
    }

    /**
     * Update the specified student record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id); // Use 'findOrFail' for error handling
  
        // Update the main student record 
        $student->update($request->all());
  
        // Update associated models:
        if ($request->has('academic')) {
            $student->academic()->updateOrCreate([], $request->get('academic'));
        }
        if ($request->has('country')) {
            $student->country()->updateOrCreate([], $request->get('country'));
        }
  
        // Refetch the updated student with related data:
        $student->load('academic', 'country');
  
        return response()->json($student, 200); // OK
    }

    /**
     * Remove the specified student record.
     *
     * @param  \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        try {
            $student->academic()->delete();
            $student->country()->delete();
            $student->delete();
            return response()->json(['message' => 'Student successfully deleted'], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Deletion failed'], 500); // Example: Internal server error
        }
    }
}
