<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Plan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        .hero-image {
            height: 300px;
            background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
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
                        <img src="{{ $hotel->image_url }}" class="card-img-top" alt="{{ $hotel->name }}">
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

    <!-- Itinerary Section -->
    <div class="container mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5>Itinerary</h5>
            <button class="btn btn-outline-dark rounded-pill px-3">Best Tour</button>
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
                    <div id="day{{ $itinerary->day }}"
                        class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}">
                        <div class="accordion-body">
                            @foreach ($itinerary->activities as $index => $activity)
                                <div class="card border-0 mb-3">
                                    <div class="row g-0">
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-2">
                                                    <span
                                                        class="badge bg-dark rounded-circle me-2">{{ $index + 1 }}</span>
                                                    <h6 class="card-title mb-0">{{ $activity->name }}</h6>
                                                </div>
                                                <p class="card-text text-muted">{{ $activity->description }}</p>
                                                <div class="d-flex align-items-center">
                                                    <span class="me-2">⏱ {{ $activity->recommended_duration }}
                                                        min</span>
                                                    <span>• {{ $locationOverview->name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <img src="{{ $activity->image_url }}" class="img-fluid rounded"
                                                alt="{{ $activity->name }}">
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

    <!-- Estimated Costs -->
    <div class="container mb-5">
        <h2>Estimated Costs</h2>
        <p><strong>Total Cost:</strong> {{ $cost->total_cost }} {{ $cost->currency }}</p>
        <h4>Transportation Costs</h4>
        <ul>
            @foreach ($cost->transportationCosts as $transportation)
                <li>{{ $transportation->type }}: ${{ $transportation->cost }}</li>
            @endforeach
        </ul>
        <h4>Dining Costs</h4>
        <ul>
            @foreach ($cost->diningCosts as $dining)
                <li>{{ $dining->category }}: ${{ $dining->cost }}</li>
            @endforeach
        </ul>
    </div>

    <!-- Additional Information -->
    <div class="container mb-5">
        <h2>Additional Information</h2>
        <p><strong>Local Currency:</strong> {{ $additionalInfo->currency }}</p>
        <p><strong>Exchange Rate to USD:</strong> {{ $additionalInfo->exchange_rate }}</p>
        <p><strong>Timezone:</strong> {{ $additionalInfo->timezone }}</p>
        <p><strong>Weather Forecast:</strong> {{ $additionalInfo->weather_forecast }}</p>
        <p><strong>Transportation Options:</strong> {{ $additionalInfo->means_of_transportation }}</p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
