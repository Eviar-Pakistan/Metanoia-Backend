<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Video;
use App\Models\Hospital;
use App\Models\Doctor;
use App\Models\Manager;
use App\Models\Patient;
use App\Traits\HandleResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use HandleResponse;

    /**
     * Get comprehensive dashboard statistics
     */
    public function getStatistics()
    {
        try {
            $statistics = [
                'total_users' => User::count(),
                'total_categories' => Category::count(),
                'total_videos' => Video::count(),
                'total_hospitals' => Hospital::count(),
                'total_doctors' => Doctor::count(),
                'total_managers' => Manager::count(),
                'total_patients' => Patient::count(),
                'users_by_role' => [
                    'patients' => User::where('role_id', 5)->count(),
                    'managers' => User::where('role_id', 4)->count(),
                    'admins' => User::where('role_id', 1)->count(),
                ],
                'recent_stats' => [
                    'users_this_month' => User::whereMonth('created_at', now()->month)->count(),
                    'hospitals_this_month' => Hospital::whereMonth('created_at', now()->month)->count(),
                    'doctors_this_month' => Doctor::whereMonth('created_at', now()->month)->count(),
                    'patients_this_month' => Patient::whereMonth('created_at', now()->month)->count(),
                ]
            ];

            return $this->successWithData($statistics, 'Dashboard statistics retrieved successfully');

        } catch (\Exception $e) {
            return $this->fail('Failed to retrieve dashboard statistics');
        }
    }
}
