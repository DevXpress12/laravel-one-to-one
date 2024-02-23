@extends('components.app-web-layout')

@section('content')
    <div class="container"> 
        <h1>Students</h1>
        <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">Create Student</a>

        <table class="table table-bordered table-striped table-hover"> 
            <thead>
                <tr> 
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Address</th>
                    <th>Course</th> 
                    <th>Year</th> 
                    <th>Continent</th> 
                    <th>Country Name</th> 
                    <th>Capital</th> 
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student) 
                    <tr> 
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->age }}</td>
                        <td>{{ $student->address }}</td>
                        <td>{{ optional($student->academic)->course ?? '-' }}</td>
                        <td>{{ optional($student->academic)->year ?? '-' }}</td>
                        <td>{{ optional($student->country)->continent ?? '-' }}</td>
                        <td>{{ optional($student->country)->name ?? '-' }}</td>
                        <td>{{ optional($student->country)->capital ?? '-' }}</td>
                        <td> 
                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-primary">Edit</a> 

                            <form method="POST" action="{{ route('students.destroy', $student->id) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this student?')">Delete</button> 
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> 
@endsection

