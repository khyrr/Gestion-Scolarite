<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SearchService;

class SearchController extends Controller
{
    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function index(Request $request)
    {
        // Get the query and category from the request
        $query = $request->input('query');
        $category = $request->input('category');

        // Perform the search logic using the service
        $results = $this->searchService->performSearch($query, $category);

        // Filter out the excluded categories
        $excludedCategories = ['emplois', 'classes'];

        // Check if $results is not null before filtering
        if ($results !== null) {
            $filteredResults = $results->whereNotIn('category', $excludedCategories);
        } else {
            $filteredResults = collect(); // Create an empty collection
        }

        // Return the view with the search results
        return view('search.index', [
            'results' => $filteredResults,
            'query' => $query,
            'category' => $category,
        ]);
    }
}
