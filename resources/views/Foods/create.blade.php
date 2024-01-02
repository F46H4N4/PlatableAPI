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
                <a class="navbar-brand" href="{{ URL::to('Foods') }}">View all tasks</a>
            </div>
            <a class="navbar-brand" href="{{ URL::to('Donor/create') }}">Add Donor</a>
            <a class="navbar-brand" href="{{ URL::to('Recipient/create') }}">Add Recipient</a>


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

            <form action="{{ route('Foods.store') }}" method="post">
                @csrf
                <label for="recipientId">Recipient</label>
                  <select name="recipientId" id="recipientId">
                   @foreach($recipients as $recipient)
            <option value="{{ $recipient->id }}">{{ $recipient->name }}</option>
                  @endforeach
                   </select>
                   <label for="donorId">Donor</label>
                  <select name="donorId" id="donorId">
                   @foreach($donors as $donor)
            <option value="{{ $donor->id }}">{{ $donor->name }}</option>
                  @endforeach
                   </select>
                <div class="row">
                    <div class="col">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter name here..">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="description">Description</label>
                        <input type="text" name="description" id="description" class="form-control" placeholder="Description">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="expiryDate">Expiry Date</label>
                        <input type="date" name="expiryDate" id="expiryDate" class="form-control" placeholder="Expiry Date">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Quantity">
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
