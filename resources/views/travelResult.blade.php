<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $locationOverview->location }} Trip Plan - Wonderplan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .day-section {
            border-left: 2px solid #dee2e6;
            margin-left: 20px;
            padding-left: 20px;
            position: relative;
        }

        .day-marker {
            position: absolute;
            left: -10px;
            background: #fff;
            border: 2px solid #dee2e6;
            border-radius: 50%;
            width: 20px;
            height: 20px;
        }

        .activity-card {
            transition: all 0.3s ease;
        }

        .activity-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .cost-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
        }

        .trip-details-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        .reference-code {
            background: #e9ecef;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        .trip-info {
            display: grid;
            gap: 10px;
        }

        .trip-info p {
            margin: 0;
        }

        .trip-info strong {
            color: #495057;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Wonderplan</a>
            <div class="d-flex">
                <button class="btn btn-outline-dark me-2">
                    <i class="bi bi-bookmark"></i>
                </button>
                <button class="btn btn-outline-dark me-2">
                    <i class="bi bi-share"></i>
                </button>
                <button class="btn btn-outline-dark">
                    <i class="bi bi-download"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <div class="position-relative">
        <img src="{{ $locationOverview->image_url }}" class="w-100" style="height: 400px; object-fit: cover;"
            alt="{{ $tripDetails['location'] }}">
        <div class="position-absolute bottom-0 start-0 w-100 p-4"
            style="background: linear-gradient(transparent, rgba(0,0,0,0.8));">
            <div class="container">
                <h1 class="text-white">{{ $tripDetails['totalDays'] }} days trip in {{ $tripDetails['location'] }}
                </h1>
                <p class="text-white mb-0">
                    <i class="bi bi-calendar-event"></i>
                    {{ $locationOverview->start_date }} - {{ $locationOverview->end_date }}
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container my-5">
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-8">
                <!-- Overview Section -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h3>Overview</h3>
                        <p>{{ $locationOverview->history_and_culture }}
                            {{ $locationOverview->geographic_features_and_climate }}</p>

                        <!-- Additional Information -->
                        <div class="mt-4">
                            <h5><i class="bi bi-info-circle"></i> Additional Information</h5>

                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <h6>Local Currency</h6>
                                        <p>{{ $additionalInfo->local_currency }}</p>
                                    </div>

                                    <div class="mb-3">
                                        <h6>Exchange Rate</h6>
                                        <p>{{ $additionalInfo->exchange_rate }}</p>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <h6>Timezone</h6>
                                        <p>{{ $additionalInfo->timezone }}</p>
                                    </div>

                                    <div class="mb-3">
                                        <h6>Weather</h6>
                                        <p>{{ $additionalInfo->weather_forecast }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Full Width Transportation Options -->
                            <div class="mb-3">
                                <h6>Transportation Options</h6>
                                <p>{{ $additionalInfo->transportation_options }}</p>
                            </div>

                            <div class="mb-3">
                                <h6>Local Customs And Traditions</h6>
                                <p>{{ $locationOverview->local_customs_and_traditions }}</p>
                            </div>


                        </div>

                        <!-- Security Advice -->

                    </div>
                </div>

                <!-- Hotels Section -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h3>Recommended Hotels</h3>
                        @foreach ($hotels as $hotel)
                            <div class="card activity-card mb-3">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="{{ $hotel->image_url }}" class="img-fluid rounded-start"
                                            style="height: 100%; object-fit: cover;" alt="{{ $hotel->name }}">
                                        <span class="cost-badge">{{ $hotel->price_per_night }}/night</span>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $hotel->name }}</h5>
                                            <p class="card-text">{{ $hotel->description }}</p>
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    <i class="bi bi-star-fill text-warning"></i> {{ $hotel->rating }}/5
                                                    <i class="bi bi-geo-alt ms-3"></i> {{ $hotel->address }}
                                                </small>
                                            </p>
                                            <div class="mt-2">
                                                <span class="badge bg-secondary me-2">{{ $hotel->amenities }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Itinerary -->
                @foreach ($itineraries as $itinerary)
                    <div class="day-section mb-4">
                        <div class="day-marker"></div>
                        <!-- Collapsible Header -->
                        <div class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                            data-bs-target="#day{{ $itinerary->day }}" role="button" aria-expanded="true">
                            <div>
                                <h3>Day {{ $itinerary->day }}</h3>
                                <p class="text-muted mb-0">
                                    {{ \Carbon\Carbon::parse($locationOverview->start_date)->addDays($itinerary->day - 1)->format('D, d M') }}
                                </p>
                            </div>
                            <i class="bi bi-chevron-down"></i>
                        </div>

                        <!-- Collapsible Content -->
                        <div class="collapse show" id="day{{ $itinerary->day }}">
                            @foreach ($itinerary->activities as $activity)
                                <div class="card activity-card mb-3 mt-3">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img src="{{ $activity->image_url }}" class="img-fluid rounded-start"
                                                style="height: 100%; object-fit: cover;" alt="{{ $activity->name }}">
                                            <span class="cost-badge">{{ $activity->cost }}</span>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $activity->name }}</h5>
                                                <p class="card-text">{{ $activity->description }}</p>
                                                <p class="card-text">
                                                    <small class="text-muted">
                                                        <i class="bi bi-clock"></i> {{ $activity->best_time }}
                                                        {{-- <i class="bi bi-clock"></i> {{ $activity->best_time }} min --}}
                                                        <i class="bi bi-geo-alt ms-3"></i> {{ $activity->address }}
                                                    </small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Right Column -->
            <div class="col-md-4">
                <!-- Estimated Costs -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h4>Estimated Cost</h4>

                        <!-- Transportation -->
                        <h6 class="mt-4"><i class="bi bi-car-front"></i> Transportation</h6>
                        @if ($cost && $cost->transportationCosts)
                            @foreach ($cost->transportationCosts as $transport)
                                <div class="d-flex justify-content-between mb-2">
                                    <span>{{ $transport->type }}</span>
                                    <span>{{ $transport->cost }}</span>
                                </div>
                            @endforeach
                        @endif

                        <!-- Food -->
                        <h6 class="mt-4"><i class="bi bi-cup-hot"></i> Dining</h6>
                        @if ($cost && $cost->diningCosts)
                            @foreach ($cost->diningCosts as $dining)
                                <div class="d-flex justify-content-between mb-2">
                                    <span>{{ $dining->category }}</span>
                                    <span>{{ $dining->cost_range }}</span>
                                </div>
                            @endforeach
                        @endif

                        <!-- Accommodation -->
                        {{-- <h6 class="mt-4"><i class="bi bi-building"></i> Accommodation</h6> --}}
                        {{-- <div class="d-flex justify-content-between mb-2">
                            <span>Hostel</span>
                            <span>$20</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Budget Hotel</span>
                            <span>$50</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Mid-Range Hotel</span>
                            <span>$100</span>
                        </div> --}}
                    </div>
                </div>

                <!-- Emergency Facilities -->
                <div class="card">
                    <div class="card-body">
                        <div class="">
                            <h5><i class="bi bi-shield-check"></i> Security Advice</h5>
                            <p><strong>Safety Rating:</strong> {{ $securityAdvice->overall_safety_rating }}</p>
                            <p><strong>Emergency Numbers:</strong> {{ $securityAdvice->emergency_numbers }}</p>
                            <div class="mb-2">
                                <strong>Safety Tips:</strong>
                                <ul>
                                    @foreach ($securityAdvice->safety_tips as $tip)
                                        <li>{{ $tip }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <p><strong>Areas to Avoid:</strong> {{ $securityAdvice->areas_to_avoid }}</p>
                            <p><strong>Common scams:</strong> {{ $securityAdvice->common_scams }}</p>
                            <p><strong>Health Precautions:</strong> {{ $securityAdvice->health_precautions }}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4>Emergency Facilities</h4>
                        @foreach ($securityAdvice->emergencyFacilities as $facility)
                            <div class="mb-3">
                                <h6>{{ $facility->name }}</h6>
                                <p class="mb-1"><small><i class="bi bi-geo-alt"></i>
                                        {{ $facility->address }}</small>
                                </p>
                                <p class="mb-0"><small><i class="bi bi-telephone"></i>
                                        {{ $facility->phone }}</small>
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="trip-details-section">
        <h2>Trip Details</h2>
        <div class="reference-code">
            Reference Code: <strong>{{ $referenceCode }}</strong>
        </div>
        <div class="trip-info">
            <p><strong>Location:</strong> {{ $location }}</p>
            <p><strong>Duration:</strong> {{ $duration }} days</p>
            <p><strong>Travelers:</strong> {{ $traveler }}</p>
            <p><strong>Budget:</strong> {{ $budget }}</p>
            <p><strong>Selected Activities:</strong> {{ $activities }}</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
