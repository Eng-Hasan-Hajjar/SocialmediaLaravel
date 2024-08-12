<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FacebookPage;
use Illuminate\Http\Request;

class FacebookPageController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $facebookPages = FacebookPage::with('category')->get();
        return view('backend.facebook_pages.index', compact('facebookPages','categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.facebook_pages.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url',
            'description' => 'nullable|string',
            'followers_count' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        FacebookPage::create($request->all());

        return redirect()->route('facebook_pages.index')->with('success', 'Facebook Page created successfully.');
    }

    public function edit(FacebookPage $facebookPage)
    {
        $categories = Category::all();
        return view('backend.facebook_pages.edit', compact('facebookPage', 'categories'));
    }

    public function update(Request $request, FacebookPage $facebookPage)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url',
            'description' => 'nullable|string',
            'followers_count' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        $facebookPage->update($request->all());

        return redirect()->route('facebook_pages.index')->with('success', 'Facebook Page updated successfully.');
    }

    public function destroy(FacebookPage $facebookPage)
    {
        $facebookPage->delete();
        return redirect()->route('facebook_pages.index')->with('success', 'Facebook Page deleted successfully.');
    }

    public function filter(Request $request)
    {
        $query = FacebookPage::query();

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('min_followers')) {
            $query->where('followers_count', '>=', $request->min_followers);
        }

        if ($request->filled('max_followers')) {
            $query->where('followers_count', '<=', $request->max_followers);
        }

        $facebookPages = $query->with('category')->get();

        return view('backend.facebook_pages.index', compact('facebookPages'));
    }
}
