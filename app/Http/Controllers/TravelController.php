<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\LocationOverview;
use App\Models\Hotel;
use App\Models\Itinerary;
use App\Models\Activity;
use App\Models\Cost;
use App\Models\TransportationCost;
use App\Models\DiningCost;
use App\Models\AdditionalInformation;

class TravelController extends Controller
{
    public function generateTravelPlan(Request $request)
    {
        // Step 1: Validate the form data
        $request->validate([
            'location' => 'required|string',
            'date' => 'required|date',
            'duration' => 'required|integer|min:1',
            'budget' => 'required|string',
            'traveler' => 'required|string',
            'activities' => 'required|array',
        ]);

        // Step 2: Prepare the prompt for the Gemini AI API
        $location = $request->input('location');
        $totalDays = $request->input('duration');
        $traveler = $request->input('traveler');
        $budget = $request->input('budget');
        $activities = implode(', ', $request->input('activities'));

        $prompt = "
    You are a travel planning assistant. Generate a travel plan based on the following specifications and return it ONLY as a valid JSON object. Do not include any other text or explanations.

    Location: {$location}
    Duration: {$totalDays} days
    Travelers: {$traveler}
    Budget Level: {$budget}
    Preferred Activities: {$activities}

    Please ensure:
    - At least **4 hotels** are suggested with detailed information.
    - Each day in the itinerary includes at least **4 activities** with descriptions, cost, duration, best times, and coordinates.
    - Prices are in the local currency.

    Return a JSON object with these exact keys:
    {
        \"location_overview\": {
            \"history_and_culture\": \"string\",
            \"local_customs_and_traditions\": \"string\",
            \"geographic_features_and_climate\": \"string\",
            \"historical_events_and_landmarks\": [{\"name\": \"string\", \"description\": \"string\"}],
            \"cultural_highlights\": [{\"name\": \"string\", \"description\": \"string\"}]
        },
        \"hotels\": [
            {
                \"name\": \"string\",
                \"address\": \"string\",
                \"price_per_night\": \"string\",
                \"rating\": \"string\",
                \"description\": \"string\",
                \"coordinates\": \"string\",
                \"image_url\": \"string\"
            }
        ],
        \"itinerary\": [
            {
                \"day\": \"integer\",
                \"activities\": [
                    {
                        \"name\": \"string\",
                        \"description\": \"string\",
                        \"coordinates\": \"string\",
                        \"cost\": \"string\",
                        \"duration\": \"string\",
                        \"best_time\": \"string\"
                    }
                ]
            }
        ],
        \"costs\": [
            {
                \"transportation\": [{\"type\": \"string\", \"cost\": \"string\"}],
                \"dining\": [{\"category\": \"string\", \"cost_range\": \"string\"}]
            }
        ],
        \"additional_information\": {
            \"local_currency\": \"string\",
            \"exchange_rate\": \"string\",
            \"timezone\": \"string\",
            \"weather_forecast\": \"string\",
            \"transportation_options\": \"string\"
        }
    }
";


        $apiKey = env('GOOGLE_GEN_AI_API_KEY');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=$apiKey", [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ]
        ]);


        // Step 3: Decode the API response
        $responseBody = $response->json();

        // Get the generated text and clean it
        $generatedText = $responseBody['candidates'][0]['content']['parts'][0]['text'];

        // Clean the response - remove any markdown formatting or extra text
        $generatedText = preg_replace('/```json\s*|\s*```/', '', $generatedText);
        $generatedText = trim($generatedText);

        try {
            $travelPlan = json_decode($generatedText, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            \Log::error('AI Response JSON parsing failed', [
                'error' => $e->getMessage(),
                'response' => $generatedText
            ]);
            throw new \Exception('Failed to generate valid travel plan. Please try again.');
        }

        // Step 4: Save data to the database
        // Save Location Overview
        $locationOverview = LocationOverview::create([
            'history_and_culture' => $travelPlan['location_overview']['history_and_culture'],
            'local_customs_and_traditions' => $travelPlan['location_overview']['local_customs_and_traditions'],
            'geographic_features_and_climate' => $travelPlan['location_overview']['geographic_features_and_climate'],
        ]);

        //[p]        return $travelPlan['location_overview'];
        $historicalLandmarks = data_get($travelPlan, 'location_overview.historical_events_and_landmarks', []);

        foreach ($historicalLandmarks as $landmark) {
            $locationOverview->historicalEventsAndLandmarks()->create([
                'name' => data_get($landmark, 'name', 'Unknown Landmark'), // Default if name is missing
                'description' => data_get($landmark, 'description', 'No description available'), // Default if description is missing
                'location_overview_id' => $locationOverview->id, // Ensure this relates to the correct location overview
            ]);
        }


        foreach ($travelPlan['location_overview']['cultural_highlights'] as $highlight) {
            $locationOverview->culturalHighlights()->create($highlight);
        }

        // Save Hotels
        foreach ($travelPlan['hotels'] as $hotelData) {
            Hotel::create($hotelData);
        }

        // Save Itinerary and Activities
        foreach ($travelPlan['itinerary'] as $dayPlan) {
            $itinerary = Itinerary::create(['day' => $dayPlan['day']]);

            foreach ($dayPlan['activities'] as $activityData) {
                $itinerary->activities()->create($activityData);
            }
        }

        // Save Costs
        foreach ($travelPlan['costs'] as $costData) {
            $cost = Cost::create($costData);

            foreach ($costData['transportation'] as $transportData) {
                $cost->transportationCosts()->create($transportData);
            }

            foreach ($costData['dining'] as $diningData) {
                $cost->diningCosts()->create($diningData);
            }
        }

        // Save Additional Information
        AdditionalInformation::create($travelPlan['additional_information']);

        // Step 5: Pass data to the view
        // return view('travel-plan', ['travelPlan' => $travelPlan]);

        // return view('travel-plan', [
        //     'locationOverview' => $locationOverview,
        //     'hotels' => $hotels,
        //     'itineraries' => $itineraries,
        //     'cost' => $cost,
        //     'additionalInfo' => $additionalInfo,
        // ]);
    }
}
