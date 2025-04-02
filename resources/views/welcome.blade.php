<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Travel Preferences - Wonderplan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/css/autoComplete.min.css"
        rel="stylesheet">
    <style>
        .card {
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid #dee2e6;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card.selected {
            border-color: #212529;
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Wonderplan</a>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Trip Planner</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">Deals</a></li>
                    <li class="nav-item">
                        <a class="btn btn-dark ms-2" href="#">Sign In</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="mb-4">Tell us your travel preferences</h1>
                <p class="text-muted mb-5">
                    Just provide some basic information, and our trip planner will
                    generate a customized itinerary based on your preferences.
                </p>

                <form action="{{ route('travel.generate') }}" method="POST">
                    @csrf

                    <!-- Destination -->
                    <div class="mb-4">
                        <label class="form-label">What is your destination of choice?</label>
                        <input type="text" class="form-control" name="location" placeholder="Enter a location"
                            required>
                    </div>

                    <!-- Travel Date -->
                    <div class="mb-4">
                        <label class="form-label">When are you planning to travel?</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>

                    <!-- Duration -->
                    <div class="mb-4">
                        <label class="form-label">How many days are you planning to travel?</label>
                        <input type="number" name="duration" class="form-control" value="3" min="1"
                            required>
                    </div>

                    <!-- Budget -->
                    <div class="mb-4">
                        <label class="form-label">What is your budget?</label>
                        <select name="budget" class="form-control" required>
                            <option value="Low">Low (0 - 1000 USD)</option>
                            <option value="Medium">Medium (1000 - 2500 USD)</option>
                            <option value="High">High (2500+ USD)</option>
                        </select>
                    </div>

                    <!-- Travelers -->
                    <div class="mb-4">
                        <label class="form-label">Who are you traveling with?</label>
                        <select name="traveler" class="form-control" required>
                            <option value="Solo">Solo</option>
                            <option value="Couple">Couple</option>
                            <option value="Family">Family</option>
                            <option value="Friends">Friends</option>
                        </select>
                    </div>

                    <!-- Activities -->
                    <div class="mb-4">
                        <label class="form-label">What activities are you interested in?</label>
                        <select name="activities[]" class="form-control" multiple required>
                            <option value="Beaches">Beaches</option>
                            <option value="City sightseeing">City sightseeing</option>
                            <option value="Outdoor adventures">Outdoor adventures</option>
                            <option value="Festivals/events">Festivals/events</option>
                            <option value="Food exploration">Food exploration</option>
                            <option value="Nightlife">Nightlife</option>
                            <option value="Shopping">Shopping</option>
                            <option value="Spa wellness">Spa wellness</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function incrementDays() {
            const input = document.getElementById("daysInput");
            input.value = parseInt(input.value) + 1;
        }

        function decrementDays() {
            const input = document.getElementById("daysInput");
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }

        document.querySelectorAll(".card").forEach((card) => {
            card.addEventListener("click", function() {
                // For single selection (budget and travel companions)
                if (
                    this.closest(".mb-4")
                    .querySelector(".form-label")
                    .textContent.includes("Budget") ||
                    this.closest(".mb-4")
                    .querySelector(".form-label")
                    .textContent.includes("traveling with")
                ) {
                    this.closest(".row")
                        .querySelectorAll(".card")
                        .forEach((c) => c.classList.remove("selected"));
                }
                this.classList.toggle("selected");
            });
        });
    </script>
</body>

</html>
