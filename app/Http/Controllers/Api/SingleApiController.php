<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Device;
use App\Models\Question;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Video;
use App\Models\Video_session;
use App\Models\VideoRunning;
use Illuminate\Http\Request;
use App\Traits\HandleResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Transaction;

class SingleApiController extends Controller
{
    use HandleResponse;

    public function category_index($id = null)
    {
        // Ensure the user is authenticated
        if ($user = Auth::user()) {
            // Fetch the user's subscription ID
            $subscriptionId = $user->subscription_id;

            if ($id) {
                // Fetch the category with the specified ID and its videos and subscriptions
                $category = Category::whereHas('subscriptions', function ($query) use ($subscriptionId) {
                    $query->where('subscriptions.id', $subscriptionId);
                })->with('video')->find($id);

                if (!$category) {
                    return $this->successWithData([], "Category Fetch Data", 200);
                }

                $category = $this->appendUrls($category);
                return $this->successWithData($category, "Category Fetch Data", 200);
            } else {
                // Fetch all categories with their videos and subscriptions
                $categories = Category::whereHas('subscriptions', function ($query) use ($subscriptionId) {
                    $query->where('subscriptions.id', $subscriptionId);
                })->with('video')->get();

                $categories = $categories->map(function ($category) {
                    return $this->appendUrls($category);
                });

                return $this->successWithData($categories, "Categories Fetch Data", 200);
            }
        } else {
            return $this->fail("User not authenticated", [], 200);
        }
    }
    private function appendUrls($category)
    {
        // Append full URL to category image
        if ($category->image) {
            $category->image = url("storage/app/public/" . $category->image);
        }

        // Append full URL to each video's video field
        foreach ($category->video as $video) {
            if ($video->video) {
                $video->video = url("storage/app/public/" . $video->video);
            }
        }

        return $category;
    }

    public function subscription_index($id = null)
    {
        if ($id) {
            $subscription = Subscription::find($id);
        } else {
            $subscription = Subscription::all();
        }

        return $this->successWithData($subscription, "Subscription Fetch Data", 200);
    }

    public function video_index()
    {
        // Ensure the user is authenticated
        if ($user = Auth::user()) {
            // Fetch the user's subscriptions
            $subscriptions = $user->subscription()->pluck('id');

            // Fetch videos based on the subscriptions
            $videos = Video::whereHas('category', function ($query) use ($subscriptions) {
                $query->whereHas('subscriptions', function ($subQuery) use ($subscriptions) {
                    $subQuery->whereIn('subscriptions.id', $subscriptions);
                });
            })->with('category')->get();


            $videos->each(function ($video) {
                $video->video = url(Storage::disk('public')->url("app/public/" . $video->video));
                $video->image = url(Storage::disk('public')->url("app/public/" . $video->image));
            });

            return $this->successWithData($videos, "Videos fetched successfully", 200);
        } else {
            return $this->fail("User not authenticated", [], 200);
        }
    }

    public function assign_subscription($id)
    {
        // Find the subscription by ID
        $subscription = Subscription::find($id);

        if (!$subscription) {
            return $this->fail("Subscription not found", [], 200);
        }

        // Ensure the user is authenticated
        if ($user = Auth::user()) {
            // Assign the subscription to the user
            $user->subscription_id = $id;
            $user->save();

            return $this->successMessage("Successfully assigned subscription", 200);
        } else {
            return $this->fail("User not authenticated", [], 200);
        }
    }

    public function current_user(Request $request)
    {
        // Get the authenticated user
        $authUser = Auth::user();

        if (!$authUser) {
            return $this->fail("User not authenticated", [], 401);
        }

        // Fetch the user with role and subscription relationships
        $user = User::with('role', 'subscription')->find($authUser->id);

        if (!$user) {
            return $this->fail("User not found", [], 404);
        }

        return $this->successWithData($user, "User Fetch Data", 200);
    }

    public function video_play($id)
    {
        // Get the authenticated user
        $authUser = Auth::user();

        // Check if the user is authenticated
        if (!$authUser) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        // Attempt to find the video by ID
        $video = Video::find($id);

        // Check if the video exists
        if (!$video) {
            return response()->json(['error' => 'Video not found'], 404);
        }

        // Create a new video session
        $video_session = new Video_session;
        $video_session->user_id = $authUser->id;
        $video_session->video_id = $id;
        $video_session->save();

        // Return a success response
        return response()->json(['success' => 'Video play session recorded'], 200);
    }

    public function get_video_sessions()
    {
        // Get the current date
        $today = Carbon::today();
        $startOfWeek = Carbon::now()->startOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();

        // Daily sessions
        $dailySessions = Video_session::whereDate('created_at', $today)->count();

        // Weekly sessions
        $weeklySessions = Video_session::whereBetween('created_at', [$startOfWeek, $today])->count();

        // Monthly sessions
        $monthlySessions = Video_session::whereBetween('created_at', [$startOfMonth, $today])->count();

        // Total sessions
        $totalSessions = Video_session::count();

        // Return response
        return response()->json([
            'daily_sessions' => $dailySessions,
            'weekly_sessions' => $weeklySessions,
            'monthly_sessions' => $monthlySessions,
            'total_sessions' => $totalSessions
        ]);
    }

    public function incrementOption(Request $request)
    {
        $questionText = $request->input('question');
        $selectedOptions = $request->input('options'); // Assuming 'options' is an array of selected options

        $question = Question::where('question', $questionText)->first();

        if (!$question) {
            return response()->json(['error' => 'Question not found'], 404);
        }

        $options = $question->option;

        foreach ($selectedOptions as $selectedOption) {
            if (!in_array($selectedOption, $options)) {
                return response()->json(['error' => 'Invalid option'], 400);
            }

            $optionIndex = array_search($selectedOption, $options);

            switch ($optionIndex) {
                case 0:
                    $question->increment('option_1');
                    break;
                case 1:
                    $question->increment('option_2');
                    break;
                case 2:
                    $question->increment('option_3');
                    break;
                case 3:
                    $question->increment('option_4');
                    break;
                default:
                    return response()->json(['error' => 'Invalid option index'], 400);
            }
        }

        return response()->json(['success' => 'Option counts incremented'], 200);
    }

    public function deivce_connected(Request $request)
    {
        $authUser = Auth::user();
        $device = Device::where('mac_address', $request->mac_address)->first();

        if (!$device) {
            $device = new Device();
            $device->title = $request->title;
            $device->ip_address = $request->ip_address;
            $device->mac_address = $request->mac_address;
            $device->status = 1;
            $device->user_id = $authUser->id;
            $device->save();
        } else {
            $device->status = 1;
            $device->save();
        }

        return response()->json(['success' => 'Device successfully connected'], 200);
    }

    public function device_disconnected(Request $request)
    {
        $authUser = Auth::user();
        $device = Device::where('mac_address', $request->mac_address)
            ->where('user_id', $authUser->id)
            ->first();

        if ($device) {
            $device->status = 0;
            $device->save();
        }

        return response()->json(['success' => 'Device successfully disconnected'], 200);
    }

    public function video_running(Request $request)
    {
        $authUser = Auth::user();
        $video = new VideoRunning;
        $video->video_id = $request->video_id;
        $video->user_id = $authUser->id;
        $video->is_complete = 0;
        $video->save();

        return response()->json(['success' => 'Video successfully running'], 200);
    }

    public function mobile_video_running(Request $request)
    {
        $authUser = Auth::user();
        $video = new VideoRunning;
        $video->video_id = $request->video_id;
        $video->user_id = $authUser->id;
        $video->is_complete = 1;
        $video->save();

        return response()->json(['success' => 'Video successfully running'], 200);
    }

    public function video_completed(Request $request)
    {
        $authUser = Auth::user();
        $video = VideoRunning::where('video_id', $request->video_id)->where('user_id', $authUser->id)->first();
        $video->is_complete = 1;
        $video->update();

        return response()->json(['success' => 'Video successfully completed'], 200);
    }

    public function question_get()
    {
        $question = Question::get();
        return response()->json($question);
    }

    public function getEncodedUrl()
    {
        $user_id = Auth::user()->id;
        $encodedUserId = base64_encode($user_id);

        $url = url('subscription-plan/' . $encodedUserId);

        // Return the URL
        return response()->json(['url' => $url]);
    }

}
