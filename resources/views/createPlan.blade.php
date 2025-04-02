<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Travel Preferences - Wonderplan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
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
                        <label class="form-label">What is destination of choice?</label>
                        <select class="form-select" name="location" required>
                            <option value="" selected disabled>Select a destination</option>
                            <option value="New York">New York</option>
                            <option value="Lagos">Lagos</option>
                            <option value="London">London</option>
                            <option value="Paris">Paris</option>
                            <option value="Tokyo">Tokyo</option>
                            <option value="Rome">Rome</option>
                            <option value="Barcelona">Barcelona</option>
                            <option value="Amsterdam">Amsterdam</option>
                            <option value="Dubai">Dubai</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Sydney">Sydney</option>
                        </select>
                    </div>

                    <!-- Travel Date -->
                    <div class="mb-4">
                        <label class="form-label">When are you planning to travel?</label>
                        <input type="date" class="form-control" name="travel" required />
                    </div>

                    <!-- Duration -->
                    <div class="mb-4">
                        <label class="form-label">How many days are you planning to travel?</label>
                        <div class="input-group">
                            <span class="input-group-text">Day</span>
                            <button type="button" class="btn btn-outline-secondary"
                                onclick="decrementDays()">-</button>
                            <input type="number" class="form-control text-center" value="3" id="daysInput"
                                name="duration" min="1" required />
                            <button type="button" class="btn btn-outline-secondary"
                                onclick="incrementDays()">+</button>
                        </div>
                    </div>

                    <!-- Budget Section -->
                    <div class="mb-4">
                        <input type="hidden" name="budget" id="budgetInput" required>
                        <label class="form-label">What is Your Budget?</label>
                        <p class="text-muted small">
                            The budget is exclusively allocated for activities and dining
                            purposes.
                        </p>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-wallet fs-4 mb-2"></i>
                                        <h6>Low</h6>
                                        <small class="text-muted">0 - 1000 USD</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-wallet2 fs-4 mb-2"></i>
                                        <h6>Medium</h6>
                                        <small class="text-muted">1000 - 2500 USD</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-wallet-fill fs-4 mb-2"></i>
                                        <h6>High</h6>
                                        <small class="text-muted">2500+ USD</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Travel Companions Section -->
                    <div class="mb-4">
                        <input type="hidden" name="traveler" id="companionInput" required>
                        <label class="form-label">Who do you plan on traveling with on your next
                            adventure?</label>
                        <div class="row g-3">
                            <div class="col-6 col-md-3">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-person fs-4 mb-2"></i>
                                        <h6>Solo</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-people fs-4 mb-2"></i>
                                        <h6>Couple</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-people-fill fs-4 mb-2"></i>
                                        <h6>Family</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-people-fill fs-4 mb-2"></i>
                                        <h6>Friends</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Activities Section -->
                    <div class="mb-4">
                        <input type="hidden" name="activities" id="activitiesInput" required>
                        <label class="form-label">Which activities are you interested in?</label>
                        <div class="row g-3">
                            <div class="col-6 col-md-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-umbrella-beach fs-4 mb-2"></i>
                                        <h6>Beaches</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-building fs-4 mb-2"></i>
                                        <h6>City sightseeing</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-tree fs-4 mb-2"></i>
                                        <h6>Outdoor adventures</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-calendar-event fs-4 mb-2"></i>
                                        <h6>Festivals/events</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-cup-hot fs-4 mb-2"></i>
                                        <h6>Food exploration</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-moon-stars fs-4 mb-2"></i>
                                        <h6>Nightlife</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-bag fs-4 mb-2"></i>
                                        <h6>Shopping</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-heart-pulse fs-4 mb-2"></i>
                                        <h6>Spa wellness</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-dark px-4">Submit</button>
                    </div>
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
                const section = this.closest(".mb-4");
                const label = section.querySelector(".form-label").textContent;

                // For single selection (budget and travel companions)
                if (label.includes("Budget") || label.includes("traveling with")) {
                    section.querySelectorAll(".card").forEach((c) => c.classList.remove("selected"));
                    this.classList.toggle("selected");

                    // Update hidden inputs
                    if (label.includes("Budget")) {
                        const budgetValue = this.querySelector("h6").textContent.toLowerCase();
                        document.getElementById("budgetInput").value = budgetValue;
                    } else if (label.includes("traveling with")) {
                        const companionValue = this.querySelector("h6").textContent.toLowerCase();
                        document.getElementById("companionInput").value = companionValue;
                    }
                } else {
                    // For multiple selection (activities)
                    this.classList.toggle("selected");
                    const selectedActivities = Array.from(section.querySelectorAll(".card.selected"))
                        .map(card => card.querySelector("h6").textContent.toLowerCase());
                    document.getElementById("activitiesInput").value = JSON.stringify(selectedActivities);
                }
            });
        });

        // Form validation before submit
        document.querySelector("form").addEventListener("submit", function(e) {
            const budget = document.getElementById("budgetInput").value;
            const companion = document.getElementById("companionInput").value;
            const activities = document.getElementById("activitiesInput").value;

            if (!budget || !companion || !activities) {
                e.preventDefault();
                alert("Please select all required options (Budget, Travel Companion, and at least one Activity)");
            }
        });
    </script>
</body>

</html>
