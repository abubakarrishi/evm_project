<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 11 Multi Auth</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container">
        <div class="card border-0 shadow my-5">
            <div class="card-header bg-light">
                <h3 class="h5 pt-2">Edit Candidate</h3>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
    
                <form action="{{ route('candidates.update', $candidate->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
    
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $candidate->name }}" required>
                    </div>
    
                    <div class="mb-3">
                        <label for="party_affiliation" class="form-label">Party Affiliation</label>
                        <input type="text" class="form-control" id="party_affiliation" name="party_affiliation" value="{{ $candidate->party_affiliation }}" required>
                    </div>
    
                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo</label>
                        <input type="file" class="form-control" id="photo" name="photo">
                        @if ($candidate->photo)
                            <img src="{{ asset($candidate->photo) }}" alt="{{ $candidate->name }}" class="mt-3" style="max-width: 150px;">
                        @endif
                    </div>
    
                    <button type="submit" class="btn btn-primary">Update Candidate</button>
                </form>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>