<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 11 Multi Auth</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <strong>Candidate creation</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Account
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3 class="h5 mb-0">Candidate</h3>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <form method="POST" action="{{ isset($candidate) ? route('candidates.update', $candidate->id) : route('candidates.store') }}" enctype="multipart/form-data">
                    @csrf
                    @isset($candidate)
                        @method('PUT')
                    @endisset
                
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $candidate->name ?? '') }}" placeholder="Name">
                    </div>
                
                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo</label>
                        <input type="file" class="form-control" id="photo" name="photo">
                    </div>
                
                    <div class="mb-3">
                        <label for="party_affiliation" class="form-label">Party Name</label>
                        <input type="text" class="form-control" id="party_affiliation" name="party_affiliation" value="{{ old('party_affiliation', $candidate->party_affiliation ?? '') }}" placeholder="Party Name">
                    </div>
                
                    <!-- New field for Ballot Measure Position -->
                    <div class="mb-3">
                        <label for="ballot_measure_position" class="form-label">Proposed Laws</label>
                        <textarea class="form-control" id="ballot_measure_position" name="ballot_measure_position" rows="3" placeholder="Proposed Laws">{{ old('ballot_measure_position', $candidate->ballot_measure_position ?? '') }}</textarea>
                    </div>
                
                    <button type="submit" class="btn btn-primary">{{ isset($candidate) ? 'Update' : 'Create' }}</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Back</a>
                </form>
                
                
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
