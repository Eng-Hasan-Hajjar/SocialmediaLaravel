<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
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
            // تحميل كل الفئات لاستخدامها في العرض إذا لزم الأمر
            $categories = Category::all();
        $recommendations = Recommendation::with(['recommendable', 'user', 'product'])->get();
        return view('backend.recommendations.index', compact('recommendations','categories'));
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



    public function recommend(Request $request)
    {
        $messages = [
            'platforms.required' => 'The platforms field is required.',
            'category_id.required' => 'The category field is required.',


        ];
        $request->validate([
            'platforms' => 'required|array|min:1',
            'category_id' => 'required|exists:categories,id',
        ],$messages);

        $platforms = $request->input('platforms');
        $categoryId = $request->input('category_id');

        // الحصول على الموقع الحالي للمستخدم عبر علاقته مع جدول الزبائن
        $location = auth()->user()->customer->current_location;

        $allRecommendations = collect(); // استخدم collection لجمع التوصيات من المنصات المختلفة

        foreach ($platforms as $platform) {
            $recommendations = collect();

            switch ($platform) {
                case 'facebook':
                    $recommendations = FacebookPage::where('category_id', $categoryId)
                        ->where('location', $location)
                        ->orderBy('followers_count', 'desc')
                        ->take(5)
                        ->get();
                    break;

                case 'instagram':
                    $recommendations = InstagramAccount::where('category_id', $categoryId)
                        ->where('location', $location)
                        ->orderBy('followers_count', 'desc')
                        ->take(5)
                        ->get();
                    break;

                case 'youtube':
                    $recommendations = YouTubeChannel::where('category_id', $categoryId)
                        ->where('location', $location)
                        ->orderBy('subscribers_count', 'desc')
                        ->take(5)
                        ->get();
                    break;
            }

            // إضافة توصيات المنصة الحالية إلى القائمة العامة مع توضيح المنصة
            $allRecommendations = $allRecommendations->merge($recommendations->map(function($item) use ($platform) {
                $item->platform = $platform;
                return $item;
            }));
        }

        return view('backend.recommendations.results', compact('allRecommendations'));
    }



}
