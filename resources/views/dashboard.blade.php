<!-- resources/views/candidates/index.blade.php -->

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Candidate List</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-lg">
    <div class="container">
        <a class="navbar-brand" href="#">VOTE THE RIGHT PARTY</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('account.logout') }}">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="h5 mb-0">Candidates</h3>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Party Name</th>
                        <th>Vote</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($candidates as $candidate)
                    <tr>
                        <td>{{ $candidate->name }}</td>
                        <td><img src="{{ asset($candidate->photo) }}" alt="{{ $candidate->name }}" width="50"></td>
                        <td>{{ $candidate->party_affiliation }}</td>
                        <td>{{ $candidate->ballot_measure_position }}</td>
                        <td>
                            <form action="{{ route('candidates.vote', $candidate->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Vote</button>
                            </form>
                        </td>
                    </tr>
                @endforeach                
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
