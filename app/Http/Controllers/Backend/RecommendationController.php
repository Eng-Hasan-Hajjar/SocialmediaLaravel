<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FacebookPage;
use App\Models\InstagramAccount;
use App\Models\Product;
use App\Models\Recommendation;
use App\Models\User;
use App\Models\YouTubeChannel;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function index()
    {
        $recommendations = Recommendation::with(['recommendable', 'user', 'product'])->get();
        return view('backend.recommendations.index', compact('recommendations'));
    }

    public function create()
    {
        $products = Product::all();
        $facebookPages = FacebookPage::all();
        $instagramAccounts = InstagramAccount::all();
        $youtubeChannels = YouTubeChannel::all();
        return view('backend.recommendations.create', compact('products', 'facebookPages', 'instagramAccounts', 'youtubeChannels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'recommendable_id' => 'required',
            'recommendable_type' => 'required|in:FacebookPage,InstagramAccount,YouTubeChannel',
        ]);

        Recommendation::create($request->all());

        return redirect()->route('recommendations.index')->with('success', 'Recommendation created successfully.');
    }

    public function show(Recommendation $recommendation)
    {
        return view('backend.recommendations.show', compact('recommendation'));
    }

    public function edit(Recommendation $recommendation)
    {
        $products = Product::all();
        $facebookPages = FacebookPage::all();
        $instagramAccounts = InstagramAccount::all();
        $youtubeChannels = YouTubeChannel::all();
        return view('backend.recommendations.edit', compact('recommendation', 'products', 'facebookPages', 'instagramAccounts', 'youtubeChannels'));
    }

    public function update(Request $request, Recommendation $recommendation)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'recommendable_id' => 'required',
            'recommendable_type' => 'required|in:FacebookPage,InstagramAccount,YouTubeChannel',
        ]);

        $recommendation->update($request->all());

        return redirect()->route('recommendations.index')->with('success', 'Recommendation updated successfully.');
    }

    public function destroy(Recommendation $recommendation)
    {
        $recommendation->delete();
        return redirect()->route('recommendations.index')->with('success', 'Recommendation deleted successfully.');
    }
}
