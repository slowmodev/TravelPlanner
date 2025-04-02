<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lagos Trip Planner</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <style>
        .hero-image {
            height: 300px;
            background-image: linear-gradient(rgba(0, 0, 0, 0.4),
                    rgba(0, 0, 0, 0.4)),
                url("{{ $locationOverview->image_url }}");
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .hero-text {
            position: absolute;
            bottom: 20px;
            left: 20px;
            color: white;
        }

        .hotel-card img {
            height: 200px;
            object-fit: cover;
        }

        .rating {
            color: #ffc107;
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
    <div class="hero-image mb-4">
        <div class="hero-text">
            <h2>{{ $locationOverview->name }}</h2>
            <p>{{ $tripDates }}</p>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="container mb-4">
        <div class="d-flex gap-2">
            <button class="btn btn-dark">Overview</button>
            <button class="btn btn-outline-dark">General Information</button>
        </div>
    </div>

    <!-- Description -->
    <div class="container mb-4">
        <h5>Description</h5>
        <p>{{ $locationOverview->history_and_culture }}</p>
    </div>

    <!-- Lodging Section -->
    <div class="container mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5>Lodging Recommendation</h5>
            <span>{{ count($hotels) }} Hotels found based on your interests</span>
        </div>

        <div class="row">
            @foreach ($hotels as $hotel)
                <div class="col-md-4">
                    <div class="card hotel-card mb-3">
                        <img src="{{ $hotel->image_url }}" class="card-img-top" alt="{{ $hotel->name }}" />
                        <div class="card-body">
                            <h6>{{ $locationOverview->name }}</h6>
                            <h5 class="card-title">{{ $hotel->name }}</h5>
                            <div class="rating">★ {{ $hotel->rating }}</div>
                            <p class="card-text">${{ $hotel->price_per_night }} /night</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Read Only Notice -->
    <div class="container mb-4">
        <div class="alert alert-info d-flex align-items-center">
            <span>This trip is currently set to read-only mode. </span>
            <a href="#" class="ms-2">Sign in</a>
            <span class="ms-2">to gain complete access to the trip.</span>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>

    <!-- Itinerary Section -->
    <div class="container mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5>Itinerary</h5>
            <button class="btn btn-outline-dark rounded-pill px-3">
                Best Tour
            </button>
        </div>

        <div class="accordion" id="itineraryAccordion">
            @foreach ($itineraries as $itinerary)
                <div class="accordion-item border-0">
                    <h2 class="accordion-header">
                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button"
                            data-bs-toggle="collapse" data-bs-target="#day{{ $itinerary->day }}">
                            Day {{ $itinerary->day }}
                            <small class="text-muted ms-2">{{ $itinerary->date }}</small>
                        </button>
                    </h2>
                    <div id="day{{ $itinerary->day }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}">
                        <div class="accordion-body">
                            @foreach ($itinerary->activities as $index => $activity)
                                <div class="card border-0 mb-3">
                                    <div class="row g-0">
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-2">
                                                    <span class="badge bg-dark rounded-circle me-2">{{ $index + 1 }}</span>
                                                    <h6 class="card-title mb-0">{{ $activity->name }}</h6>
                                                </div>
                                                <p class="card-text text-muted">{{ $activity->description }}</p>
                                                <div class="d-flex align-items-center">
                                                    <span class="me-2">⏱ {{ $activity->recommended_duration }} min</span>
                                                    <span>• {{ $locationOverview->name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <img src="{{ $activity->image_url }}" class="img-fluid rounded" alt="{{ $activity->name }}" />
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Estimated Costs Section -->
    <div class="container mb-5">
        <div class="accordion" id="costsAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#estimatedCosts">
                        Estimated Cost ({{ $cost->currency }})
                    </button>
                </h2>
                <div id="estimatedCosts" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        <!-- Transportation -->
                        <div class="mb-4">
                            <h6 class="d-flex align-items-center mb-3">
                                <i class="bi bi-car-front me-2"></i>
                                Transportation
                            </h6>
                            <div class="row g-3">
                                @foreach ($cost->transportationCosts as $transport)
                                    <div class="col-6 col-md-3">
                                        <div class="d-flex flex-column">
                                            <small class="text-muted">{{ $transport->type }}</small>
                                            <span>${{ $transport->cost }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Food -->
                        <div class="mb-4">
                            <h6 class="d-flex align-items-center mb-3">
                                <i class="bi bi-cup-hot me-2"></i>
                                Food
                            </h6>
                            <div class="row g-3">
                                @foreach ($cost->diningCosts as $dining)
                                    <div class="col-6 col-md-3">
                                        <div class="d-flex flex-column">
                                            <small class="text-muted">{{ $dining->category }}</small>
                                            <span>${{ $dining->cost }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Add Bootstrap Icons */
        @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css");

        /* Custom styles for cost section */
        .accordion-body .row>div {
            margin-bottom: 0.5rem;
        }

        .accordion-body small {
            font-size: 0.875rem;
        }

        .accordion-body span {
            font-weight: 500;
        }

        /* Icon styles */
        .bi {
            font-size: 1.2rem;
        }
    </style>

    <style>
        /* Custom CSS for itinerary section */
        .accordion-button:not(.collapsed) {
            background-color: transparent;
            box-shadow: none;
        }

        .accordion-button:focus {
            box-shadow: none;
        }

        .badge.bg-dark {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card img {
            height: 100%;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            .card img {
                height: 200px;
            }
        }
    </style>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
