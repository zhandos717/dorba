<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        return ReviewResource::collection(Review::all());
    }

    public function store(ReviewRequest $request)
    {
        return new ReviewResource(Review::create($request->validated()));
    }

    public function show(Review $review)
    {
        return new ReviewResource($review);
    }

    public function update(ReviewRequest $request, Review $review)
    {
        $review->update($request->validated());

        return new ReviewResource($review);
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return response()->json();
    }
}
