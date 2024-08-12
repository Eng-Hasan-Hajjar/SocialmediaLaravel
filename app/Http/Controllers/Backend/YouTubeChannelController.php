<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\YouTubeChannel;
use Illuminate\Http\Request;

class YouTubeChannelController extends Controller
{
    public function index()
    {
        $youtubeChannels = YouTubeChannel::with('category')->get();
        $categories = Category::all();
        return view('backend.youtube_channels.index', compact('youtubeChannels','categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.youtube_channels.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url',
            'description' => 'nullable|string',
            'subscribers_count' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        YouTubeChannel::create($request->all());

        return redirect()->route('youtube_channels.index')->with('success', 'YouTube Channel created successfully.');
    }

    public function edit(YouTubeChannel $youtubeChannel)
    {
        $categories = Category::all();
        return view('backend.youtube_channels.edit', compact('youtubeChannel', 'categories'));
    }

    public function update(Request $request, YouTubeChannel $youtubeChannel)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url',
            'description' => 'nullable|string',
            'subscribers_count' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        $youtubeChannel->update($request->all());

        return redirect()->route('youtube_channels.index')->with('success', 'YouTube Channel updated successfully.');
    }

    public function destroy(YouTubeChannel $youtubeChannel)
    {
        $youtubeChannel->delete();
        return redirect()->route('youtube_channels.index')->with('success', 'YouTube Channel deleted successfully.');
    }

    public function filter(Request $request)
    {
        $query = YouTubeChannel::query();

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('min_subscribers')) {
            $query->where('subscribers_count', '>=', $request->min_subscribers);
        }

        if ($request->filled('max_subscribers')) {
            $query->where('subscribers_count', '<=', $request->max_subscribers);
        }

        $youtubeChannels = $query->with('category')->get();
      //  $categories  = Category::all();
        return view('backend.youtube_channels.index', compact('youtubeChannels',));
    }
}
