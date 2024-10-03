<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Feedbacks</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .custom-background {
            background-color: #f9f9f9; /* Light gray background */
        }
        .feedback-container {
            background: #ffffff; /* White container */
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }
        .feedback-title {
            font-size: 1.2em;
            color: #4CAF50; /* Dark green */
        }
        .feedback-comment {
            font-size: 1em;
            color: #333;
            margin-top: 10px;
        }
        .feedback-info {
            font-size: 0.9em;
            color: #666;
        }
        .leave-feedback-button {
            background-color: #4CAF50; /* Dark green to match feedback title */
            color: white;
            border: none;
            width: 200px;
            padding: 8px 16px; /* Reduced padding for a smaller button */
            border-radius: 5px;
            display: flex;
            align-items: center;
            margin-top: 10px;
            text-decoration: none; /* Remove underline from link */
        }
        .leave-feedback-button i {
            margin-right: 8px; /* Space between icon and text */
        }
        .feedback-buttons {
            margin-top: 10px;
        }
        .feedback-buttons a,
        .feedback-buttons form {
            display: inline-block;
        }
    </style>
</head>
<body class="custom-background">
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
    <a href="index.html" class="navbar-brand d-flex align-items-center border-end px-4 px-lg-5">
        <h2 class="m-0 text-primary">Solartec</h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="/" class="nav-item nav-link active">Home</a>
            <a href="" class="nav-item nav-link">About</a>
            <a href="" class="nav-item nav-link">Service</a>
            <a href="" class="nav-item nav-link">Project</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                <div class="dropdown-menu bg-light m-0">
                    <a href="" class="dropdown-item">Feature</a>
                    <a href="" class="dropdown-item">Free Quote</a>
                    <a href="" class="dropdown-item">Our Team</a>
                    <a href="" class="dropdown-item">Testimonial</a>
                    <a href="" class="dropdown-item">404 Page</a>
                </div>
            </div>
            <a href="{{ url('/Feedbacks/All') }}" class="nav-item nav-link">Feedback</a> <!-- Updated link -->
        </div>
        <a href="" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Get A Quote<i class="fa fa-arrow-right ms-3"></i></a>
    </div>
</nav>

    <div class="container mt-5">
        <h2 class="text-center mb-4">All Feedbacks</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @foreach($feedbacks as $feedback)
    <div class="feedback-container">
        <div class="feedback-title">
            <i class="fas fa-user"></i> {{ $feedback->email }}
        </div>
        <div class="feedback-info">
            <span class="rating">
                @for ($i = 0; $i < $feedback->rating; $i++)
                    <i class="fas fa-star" style="color: gold;"></i>
                @endfor
                @for ($i = $feedback->rating; $i < 5; $i++)
                    <i class="fas fa-star" style="color: lightgray;"></i>
                @endfor
            </span>
            <span class="date"> | {{ \Carbon\Carbon::parse($feedback->date)->format('d M Y') }}</span>
        </div>
        <div class="feedback-comment">
            {{ $feedback->comment }}
        </div>

        <!-- Edit and Delete buttons -->
        <div class="mt-3">
            <a href="{{ route('feedback.edit', $feedback->id) }}" class="btn btn-primary btn-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
            <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" class="d-inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this feedback?')">
                    <i class="fas fa-trash-alt"></i> Delete
                </button>
            </form>
        </div>
    </div>
@endforeach
        
        <!-- Leave a Feedback Button -->
        <div class="text-center">
            <a href="{{ url('/feedback/create') }}" class="leave-feedback-button">
                <i class="fas fa-comment-dots"></i> Leave a Feedback
            </a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
