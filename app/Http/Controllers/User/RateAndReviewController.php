<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\RateAndReview;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RateAndReviewController extends Controller
{
    public function reviewPage($id) {
        $productData = Product::where('id', $id)->get();
        $reviewData = RateAndReview::join('users', 'rate_and_reviews.user_id', '=', 'users.id')
                    ->select('rate_and_reviews.*', 'users.name', 'users.image')
                    ->where('product_id', $id)
                    ->get();
        // Star count & caulating average rate
        $starCount = $this->StarCount($id);

        return view('user.review_rate', ['productData' => $productData, 'starCount' => $starCount, 'reviewData' => $reviewData]);
    }

    // Review creating
    public function reviewCreate(Request $request) {
        $userId = Auth::user()->id;
        $data = $this->RequestData($request, $userId);
        if(RateAndReview::where(['product_id' => $request->product_id, 'user_id' => $userId])->exists()) {
            return redirect()->back()->with(['alertfail' => 'You have been reviewed for this product once.']);
        }else {
            RateAndReview::create($data);
            // rating to product
            $starCount = $this->StarCount($request->product_id);
            $totalRateCount = $starCount['oneStar']+$starCount['twoStar']+$starCount['threeStar']+$starCount['fourStar']+$starCount['fiveStar'];

            $result = ceil((1 * $starCount['oneStar'] +
                        2 * $starCount['twoStar'] +
                        3 * $starCount['threeStar'] +
                        4 * $starCount['fourStar'] +
                        5 * $starCount['fiveStar'] ) / $totalRateCount);
            $rate = intval($result);
            $data = [
                'rate' => $rate,
            ];
            Product::where('id', $request->product_id)->update($data);
            return redirect()->back()->with(['alertsuccess' => 'Your review was sucessfully uploaded. Thanks!']);
        }
    }

    // returning stars
    private function StarCount($id) {
        return [
            'oneStar' => $this->GetStar($id, 1),
            'twoStar' => $this->GetStar($id, 2),
            'threeStar' => $this->GetStar($id, 3),
            'fourStar' => $this->GetStar($id, 4),
            'fiveStar' => $this->GetStar($id, 5),
        ];
    }

    // Star count checking
    private function GetStar($id, $star) {
        $starCount = RateAndReview::where(['product_id'=> $id, 'star_count'=> $star])->get();
        return count($starCount);
    }

    // Inserting data
    private function RequestData($request, $userId) {
        return [
            'product_id' => $request->product_id,
            'star_count' => $request->star,
            'review' => $request->review,
            'user_id' => $userId,
        ];
    }
}
