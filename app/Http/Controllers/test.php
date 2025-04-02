<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Google\GenerativeAi;

class TravelController extends Controller
{
    // public function generateTravelPlan(Request $request)
    // {
    //     // Step 1: Validate the form data
    //     $request->validate([
    //         'location' => 'required|string',
    //         'date' => 'required|date',
    //         'duration' => 'required|integer|min:1',
    //         'budget' => 'required|string',
    //         'traveler' => 'required|string',
    //         'activities' => 'required|array',
    //     ]);

    //     // Step 2: Prepare the prompt for the Gemini AI API
    //     $location = $request->input('location');
    //     $totalDays = $request->input('duration');
    //     $traveler = $request->input('traveler');
    //     $budget = $request->input('budget');
    //     $activities = implode(', ', $request->input('activities'));

    //     $prompt = "
    //     Please create a detailed travel plan with the following specifications:

    //     Location: {$location}
    //     Duration: {$totalDays} days
    //     Travelers: {$traveler}
    //     Budget Level: {$budget}
    //     Preferred Activities: {$activities}

    //     Please provide:
    //     1. Location Overview:
    //        - Brief history and cultural significance
    //        - Notable historical events and landmarks
    //        - Local customs and traditions
    //        - Cultural highlights and unique characteristics
    //        - Geographic features and climate patterns

    //     2. Hotel Options (3-4 choices):
    //        - Name, Address, Price per night
    //        - Rating and Brief description
    //        - Location coordinates
    //        - Representative image URL

    //     3. Daily Itinerary:
    //        - Day-by-day breakdown
    //        - For each attraction/activity:
    //          * Name and description
    //          * Location coordinates
    //          * Entrance fees/costs
    //          * Recommended duration
    //          * Best time to visit

    //     4. Estimated Costs (in local currency):
    //        - Transportation options and rates
    //        - Dining costs by category
    //        - Activity/entrance fees

    //     5. Additional Information:
    //        - Local currency and exchange rate to USD
    //        - Timezone
    //        - Weather forecast
    //        - Means of transportation available

    //     Please format the response as a JSON object.
    //     ";

    //     // Step 3: Integrate with the Gemini AI API using the updated code
    //     $apiKey = config('services.google_gen_ai.api_key');
    //     $genAI = new GoogleGenerativeAI($apiKey);

    //     $genAI->getGenerativeModel('gemini-1.5-flash');

    //     $generationConfig = [
    //         'temperature' => 1,
    //         'topP' => 0.95,
    //         'topK' => 40,
    //         'maxOutputTokens' => 8192,
    //         'responseMimeType' => 'application/json',
    //     ];

    //     $history = [
    //         [
    //             'role' => 'user',
    //             'parts' => [
    //                 [
    //                     'text' => "Generate Travel Plan for Location: {$location}, for {$totalDays} days for a {$traveler} with a {$budget} budget, preferred activities: {$activities}.",
    //                 ],
    //             ],
    //         ],
    //     ];

    //     $response = $genAI->startChat($generationConfig, $history);

    //     // Step 4: Handle the response and return the result
    //     return response()->json($response);
    // }


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
        Please create a detailed travel plan with the following specifications:

        Location: {$location}
        Duration: {$totalDays} days
        Travelers: {$traveler}
        Budget Level: {$budget}
        Preferred Activities: {$activities}

        Please provide:
        1. Location Overview:
           - Brief history and cultural significance
           - Notable historical events and landmarks
           - Local customs and traditions
           - Cultural highlights and unique characteristics
           - Geographic features and climate patterns

        2. Hotel Options (3-4 choices):
           - Name, Address, Price per night
           - Rating and Brief description
           - Location coordinates
           - Representative image URL

        3. Daily Itinerary:
           - Day-by-day breakdown
           - For each attraction/activity:
             * Name and description
             * Location coordinates
             * Entrance fees/costs
             * Recommended duration
             * Best time to visit

        4. Estimated Costs (in local currency):
           - Transportation options and rates
           - Dining costs by category
           - Activity/entrance fees

        5. Additional Information:
           - Local currency and exchange rate to USD
           - Timezone
           - Weather forecast
           - Means of transportation available

        Please format the response as a JSON object.
        ";

        // Step 3: Call Google Generative AI API (Gemini) using the HTTP client
        $apiKey = env('GOOGLE_GEN_AI_API_KEY');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json',
        ])
            ->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent', [
                'prompt' => $prompt,
                'temperature' => 1,
                'topP' => 0.95,
                'topK' => 40,
                'maxOutputTokens' => 8192,
                'responseMimeType' => 'application/json',
            ]);

        // Step 4: Return the API response
        return response()->json($response->json());
    }
}
