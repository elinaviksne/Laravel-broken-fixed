<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Search for tags (used for autocomplete)
     */
    public function search(Request $request)
    {
        $query = $request->get('q', '');

        // Search tags that contain the query string
        $tags = Tag::where('name', 'like', "%{$query}%")
                    ->limit(10) // limit results
                    ->get();

        // Return JSON for JS
        return response()->json($tags);
    }
}