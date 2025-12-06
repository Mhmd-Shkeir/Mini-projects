<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Review deleted.');
    }
}
