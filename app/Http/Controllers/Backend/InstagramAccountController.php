<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstagramAccountController extends Controller
{
    public function index()
    {
        $instagramAccounts = InstagramAccount::with('category')->get();
        return view('backend.instagram_accounts.index', compact('instagramAccounts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.instagram_accounts.create', compact('categories'));
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

        InstagramAccount::create($request->all());

        return redirect()->route('instagram_accounts.index')->with('success', 'Instagram Account created successfully.');
    }

    public function edit(InstagramAccount $instagramAccount)
    {
        $categories = Category::all();
        return view('backend.instagram_accounts.edit', compact('instagramAccount', 'categories'));
    }

    public function update(Request $request, InstagramAccount $instagramAccount)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url',
            'description' => 'nullable|string',
            'followers_count' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        $instagramAccount->update($request->all());

        return redirect()->route('instagram_accounts.index')->with('success', 'Instagram Account updated successfully.');
    }

    public function destroy(InstagramAccount $instagramAccount)
    {
        $instagramAccount->delete();
        return redirect()->route('instagram_accounts.index')->with('success', 'Instagram Account deleted successfully.');
    }

    public function filter(Request $request)
    {
        $query = InstagramAccount::query();

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('min_followers')) {
            $query->where('followers_count', '>=', $request->min_followers);
        }

        if ($request->filled('max_followers')) {
            $query->where('followers_count', '<=', $request->max_followers);
        }

        $instagramAccounts = $query->with('category')->get();

        return view('backend.instagram_accounts.index', compact('instagramAccounts'));
    }

}
