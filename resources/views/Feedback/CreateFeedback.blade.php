<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Feedback</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
     <!-- Libraries Stylesheet -->
<link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
<link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        .custom-background {
            background-color: #f0f8f0; /* Light green background */
            color: #333;
        }
        .custom-container {
            background: #ffffff; /* White container */
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .custom-title {
            text-align: center;
            color: #4CAF50; /* Dark green color */
        }
        .custom-label {
            font-weight: bold;
        }
        .icon {
            margin-right: 8px;
            color: #4CAF50; /* Dark green icons */
        }
        .btn-submit {
            background-color: #4CAF50; /* Dark green submit button */
            color: white;
        }
    </style>
</head>
<body class="custom-background">
@include('frontoffice.navbar')

    <div class="container mt-5 custom-container">
        <h2 class="custom-title"><i class="fas fa-comments"></i> Create Feedback</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('feedback.store') }}" method="POST">
            @csrf

            <!-- Comment Field -->
            <div class="mb-3">
                <label for="comment" class="form-label custom-label"><i class="fas fa-pencil-alt icon"></i> Comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="4"></textarea>
            </div>

            <!-- Email Field -->
            <div class="mb-3">
                <label for="email" class="form-label custom-label"><i class="fas fa-envelope icon"></i> Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <!-- Date Field -->
            <div class="mb-3">
                <label for="date" class="form-label custom-label"><i class="fas fa-calendar-alt icon"></i> Date</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>

            <!-- Rating Field -->
            <div class="mb-3">
                <label class="form-label custom-label"><i class="fas fa-star icon"></i> Rating</label>
                <div class="star-rating">
                    <span class="fa fa-star" data-value="1"></span>
                    <span class="fa fa-star" data-value="2"></span>
                    <span class="fa fa-star" data-value="3"></span>
                    <span class="fa fa-star" data-value="4"></span>
                    <span class="fa fa-star" data-value="5"></span>
                    <input type="hidden" id="rating" name="rating" value="0">
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-submit w-100"><i class="fas fa-paper-plane"></i> Submit</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Star Rating Script -->
    <script>
        const stars = document.querySelectorAll('.star-rating .fa-star');
        const ratingInput = document.getElementById('rating');

        stars.forEach(star => {
            star.addEventListener('mouseover', () => {
                stars.forEach(s => s.classList.remove('text-success'));
                const value = star.getAttribute('data-value');
                for (let i = 0; i < value; i++) {
                    stars[i].classList.add('text-success');
                }
            });

            star.addEventListener('mouseout', () => {
                stars.forEach(s => s.classList.remove('text-success'));
                const currentRating = ratingInput.value;
                if (currentRating) {
                    for (let i = 0; i < currentRating; i++) {
                        stars[i].classList.add('text-success');
                    }
                }
            });

            star.addEventListener('click', () => {
                ratingInput.value = star.getAttribute('data-value');
                stars.forEach(s => s.classList.remove('text-success'));
                for (let i = 0; i < star.getAttribute('data-value'); i++) {
                    stars[i].classList.add('text-success');
                }
            });
        });
    </script>
</body>
@include('frontoffice.footer')

</html>
