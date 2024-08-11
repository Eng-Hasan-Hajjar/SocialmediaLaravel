<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\FacebookPage;
use App\Models\InstagramAccount;
use App\Models\YouTubeChannel;


class AdminDashboardController extends Controller
{
    public function index()
    {
        // Fetching counts for different user roles
        $customerCount = User::where('role', 'customer')->count();
        $adminCount = User::where('role', 'admin')->count();
        $employeeCount = User::where('role', 'employee')->count();


        // Fetching counts for social media accounts
        $facebookPageCount = FacebookPage::count();
        $instagramAccountCount = InstagramAccount::count();
        $youtubeChannelCount = YouTubeChannel::count();


        // Passing all data to the view
        return view('layouts.app', compact(
            'customerCount', 'adminCount', 'employeeCount',
             'facebookPageCount',
            'instagramAccountCount', 'youtubeChannelCount',
        ));
    }
}
