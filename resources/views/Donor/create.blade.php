<!DOCTYPE html>
<html>
<head>
    <title>Tasks Handling</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">

        <nav class="navbar navbar-inverse">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ URL::to('Tasks') }}">View all tasks</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="{{ URL::to('Foods/create') }}">Create a Task</a></li>
            </ul>
        </nav>

        <div class="content">
            <h1>Create a Task</h1>
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif

            <!-- Display validation errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('Donor.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter name here..">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="contact_info">Contact Information</label>
                        <input type="contact_info" name="contact_info" id="contact_info" class="form-control" placeholder="contact information">
                    </div>
                </div>
                <div class="my-2">
                    <button type="submit" class="btn btn-success w-100">Submit</button>
                </div>
            </form>
        </div>

    </div>
</body>
</html>