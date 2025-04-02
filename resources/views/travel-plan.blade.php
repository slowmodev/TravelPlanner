<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Plan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center">Travel Plan</h1>

        {{-- Location Overview --}}
        <section class="my-4">
            <h2>Location Overview</h2>
            <p><strong>History and Culture:</strong> {{ $locationOverview->history_and_culture }}</p>
            <p><strong>Local Customs and Traditions:</strong> {{ $locationOverview->local_customs_and_traditions }}</p>
            <p><strong>Geographic Features and Climate:</strong> {{ $locationOverview->geographic_features_and_climate }}</p>
            <h4>Historical Events and Landmarks</h4>
            <ul>
                @foreach ($locationOverview->historicalEventsAndLandmarks as $landmark)
                    <li>{{ $landmark->name }}: {{ $landmark->description }}</li>
                @endforeach
            </ul>
            <h4>Cultural Highlights</h4>
            <ul>
                @foreach ($locationOverview->culturalHighlights as $highlight)
                    <li>{{ $highlight->name }}: {{ $highlight->description }}</li>
                @endforeach
            </ul>
        </section>

        {{-- Hotel Options --}}
        <section class="my-4">
            <h2>Hotel Options</h2>
            <div class="row">
                @foreach ($hotels as $hotel)
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{ $hotel->image_url }}" class="card-img-top" alt="Hotel Image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $hotel->name }}</h5>
                                <p class="card-text">{{ $hotel->description }}</p>
                                <p><strong>Address:</strong> {{ $hotel->address }}</p>
                                <p><strong>Price per Night:</strong> ${{ $hotel->price_per_night }}</p>
                                <p><strong>Rating:</strong> {{ $hotel->rating }}/5</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- Daily Itinerary --}}
        <section class="my-4">
            <h2>Daily Itinerary</h2>
            @foreach ($itineraries as $itinerary)
                <div class="mb-3">
                    <h4>Day {{ $itinerary->day }}</h4>
                    <ul>
                        @foreach ($itinerary->activities as $activity)
                            <li>
                                <strong>{{ $activity->name }}</strong>: {{ $activity->description }} <br>
                                <strong>Location:</strong> ({{ $activity->latitude }}, {{ $activity->longitude }}) <br>
                                <strong>Entrance Fee:</strong> ${{ $activity->entrance_fee }} <br>
                                <strong>Recommended Duration:</strong> {{ $activity->recommended_duration }} hours <br>
                                <strong>Best Time to Visit:</strong> {{ $activity->best_time_to_visit }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </section>

        {{-- Estimated Costs --}}
        <section class="my-4">
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
        </section>

        {{-- Additional Information --}}
        <section class="my-4">
            <h2>Additional Information</h2>
            <p><strong>Local Currency:</strong> {{ $additionalInfo->currency }}</p>
            <p><strong>Exchange Rate to USD:</strong> {{ $additionalInfo->exchange_rate }}</p>
            <p><strong>Timezone:</strong> {{ $additionalInfo->timezone }}</p>
            <p><strong>Weather Forecast:</strong> {{ $additionalInfo->weather_forecast }}</p>
            <p><strong>Transportation Options:</strong> {{ $additionalInfo->means_of_transportation }}</p>
        </section>
    </div>
</body>
</html>
