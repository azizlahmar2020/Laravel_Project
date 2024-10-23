<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Feedbacks</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .custom-background {
            background-color: #f0f8f0; /* Light gray background */
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
@include('frontoffice.navbar')


    <div class="container mt-5">
    <a href="{{ route('feedback.statistiques') }}" class="btn btn-info">Voir les Statistiques</a>

        <h2 class="text-center mb-4">Liste des Feedbacks</h2>

 <!-- Formulaire de recherche par email -->
 <div class="mb-4">
        <input type="text" id="searchEmail" class="form-control" placeholder="Rechercher par email" onkeyup="filterFeedbacks()">
    </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @foreach($feedbacks as $feedback)
<div class="feedback-container" data-email="{{ strtolower($feedback->email) }}">
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
            <i class="fas fa-edit"></i> Editer
        </a>
        <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" class="d-inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this feedback?')">
                <i class="fas fa-trash-alt"></i> Supprimer
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
<script>
  function filterFeedbacks() {
    const searchValue = document.getElementById('searchEmail').value.toLowerCase();
    const feedbackContainers = document.querySelectorAll('.feedback-container');

    feedbackContainers.forEach(container => {
        const email = container.getAttribute('data-email');

        if (email) {
            if (email.includes(searchValue)) {
                container.style.display = '';
            } else {
                container.style.display = 'none';
            }
        }
    });
}

</script>
@include('frontoffice.footer')
