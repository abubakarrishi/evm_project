<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 11 Multi Auth</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <div class="menu">
                <button>Hello, {{ Auth::guard('admin')->user()->name }}</button>
                <div class="menu-content">
                    <a href="{{ route('admin.logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container my-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header">
                Add Candidate
            </div>
            <div class="card-body">
                <a href="{{ route('candidates.index') }}" class="btn btn-primary">Create</a>
            </div>
        </div>
        <div class="card shadow-sm mt-5">
            <div class="card-header bg-primary text-white">
                Candidates
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Photo</th>
                                <th>Party Name</th>
                                <th>Proposed Laws</th>
                                <th>Votes</th>
                                <th>Voter Emails</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($candidates as $candidate)
                                <tr>
                                    <td>{{ $candidate->name }}</td>
                                    <td><img src="{{ asset($candidate->photo) }}" alt="{{ $candidate->name }}" class="img-fluid rounded-circle"></td>
                                    <td>{{ $candidate->party_affiliation }}</td>
                                    <td>{{ $candidate->ballot_measure_position }}</td>

                                    <td>{{ $candidate->votes->count() }}</td>
                                    <td>
                                        <!-- Voter Emails Dropdown -->
                                        <div class="menu">
                                            <button class="btn btn-secondary">View Emails</button>
                                            <div class="menu-content">
                                                @foreach($candidate->votes as $vote)
                                                    <a href="#">{{ $vote->voter->email }}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('candidates.edit', $candidate->id) }}" class="btn btn-primary">Edit</a>
                                            <form action="{{ route('candidates.destroy', $candidate->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this candidate?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
