@extends('components.app-web-layout')

@section('content')
    <div class="container"> 
        <h1>Create Student</h1>

        <form action="{{ route('students.store') }}" method="post">
            @csrf

            <div class="card"> 
                <div class="card-header">Student Information</div>
                <div class="card-body"> 
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="age">Age:</label>
                        <input type="number" name="age" id="age" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" name="address" id="address" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="card mt-3"> 
                <div class="card-header">Academic Information</div>
                <div class="card-body"> 
                    <div class="form-group">
                        <label for="course">Course:</label>
                        <input type="text" name="academic[course]" id="course" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="year">Year:</label>
                        <input type="number" name="academic[year]" id="year" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">Country Information</div> 
                <div class="card-body">
                    <div class="form-group">
                        <label for="continent">Continent:</label>
                        <input type="text" name="country[continent]" id="continent" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="country_name">Name:</label>
                        <input type="text" name="country[name]" id="country_name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="capital">Capital:</label>
                        <input type="text" name="country[capital]" id="capital" class="form-control" required>
                    </div>
                </div>
            </div> 

            <div class="mt-3">
                <button type="submit" class="btn btn-success">Create Student</button>
                <a href="{{ route('students.index') }}" class="btn btn-primary">Back to Students</a>
            </div>
        </form>
    </div> 
@endsection
