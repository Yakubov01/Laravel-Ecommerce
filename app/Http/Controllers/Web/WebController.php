<?php

namespace App\Http\Controllers\Web;

use App\Models\Slider;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', '0')->get();
        return view('web.index', compact('sliders'));
    }

    public function categories()
    {
        $categories = Category::where('status', '0')->get();
        return view('web.collection.categories.index', compact('categories'));
    }

    public function products($category_slug)
    {
        $category = Category::where('slug', $category_slug)->first();

        if ($category) {
            return view('web.collection.products.index', compact('category'));
        } else {
            return redirect()->back();
        }
    }

    public function productView(string $category_slug, string $product_slug)
    {
        $category = Category::where('slug', $category_slug)->first();

        if ($category) {
            $product = $category->products()->where('slug', $product_slug)->where('status', '0')->first();

            return view('web.collection.products.view', compact('product', 'category'));
        } else {
            return redirect()->back();
        }
    }

    public function thankyou()
    {
        return view('web.thank-you');
    }
}
