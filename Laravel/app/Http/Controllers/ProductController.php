<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index($category, $sub_category){
        $perPage = 8;
        $currentPage = request()->input('page', 1);
        $offset = ($currentPage - 1) * $perPage;

        //Fetch category and subcategory ids
        $subCategoryId = DB::table('sub_categories')->where('sub_category', $sub_category)->value('id');
        $categoryId = DB::table('categories')->where('category', $category)->value('id');

        // Fetch paginated products
        $getproducts = DB::table('products as p')->join('sub_categories as s', 'p.subcategory_id', '=', 's.id')
            ->where('s.category_id', $categoryId)->where('p.subcategory_id', $subCategoryId)
            ->select(
                'p.id',
                'p.subcategory_id',
                's.category_id',
                'p.product_name',
                'p.description',
                'p.price',
                'p.stock_quatity',
                'p.image_url',
                'p.ratings',
                'p.previews'
            );
            
        $products = $getproducts->skip($offset)->take($perPage)->get();

        // Fetch total count
        $totalProducts = $getproducts->count();

        // Calculate total pages
        $totalPages = ceil($totalProducts / $perPage);

        // Calculate pagination range
        $startPage = max(1, $currentPage - 2);
        $endPage = min($totalPages, $currentPage + 2);

        if ($currentPage <= 2) {
            $endPage = min(5, $totalPages);
        }
        if ($currentPage >= $totalPages - 1) {
            $startPage = max(1, $totalPages - 4);
        }
        // Pass data to view
        return view('customer.products', [
            'products' => $products,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'startPage' => $startPage,
            'endPage' => $endPage,
            'sub_category' => $sub_category,
            'category' =>  $category,
        ]);
    }

    public function index2($category){
        $perPage = 8;
        $currentPage = request()->input('page', 1);
        $offset = ($currentPage - 1) * $perPage;

        //Fetch category and subcategory ids
        $categoryId = DB::table('categories')->where('category', $category)->value('id');

        // Fetch paginated products
        $products = DB::table('products as p')->join('sub_categories as s', 'p.subcategory_id', '=', 's.id')
            ->where('s.category_id', $categoryId)
            ->select(
                'p.id',
                'p.subcategory_id',
                's.category_id',
                'p.product_name',
                'p.description',
                'p.price',
                'p.stock_quatity',
                'p.image_url',
                'p.ratings',
                'p.previews'
            )->skip($offset)->take($perPage)
        ->get();

        // Fetch total count
        $totalProducts = DB::table('products as p')->join('sub_categories as s', 'p.subcategory_id', '=', 's.id')
            ->where('s.category_id', $categoryId)
            ->select(
                'p.id',
                'p.subcategory_id',
                's.category_id',
                'p.product_name',
                'p.description',
                'p.price',
                'p.stock_quatity',
                'p.image_url',
                'p.ratings',
                'p.previews'
            )->count();

        // Calculate total pages
        $totalPages = ceil($totalProducts / $perPage);

        // Calculate pagination range
        $startPage = max(1, $currentPage - 2);
        $endPage = min($totalPages, $currentPage + 2);

        if ($currentPage <= 2) {
            $endPage = min(5, $totalPages);
        }
        if ($currentPage >= $totalPages - 1) {
            $startPage = max(1, $totalPages - 4);
        }
        // Pass data to view
        return view('customer.products', [
            'products' => $products,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'startPage' => $startPage,
            'endPage' => $endPage,
            'category' =>  $category,
        ]);
    }

    public function productDetails($category, $sub_category, $product_id){

        //First confirm category and sub category
        $table1= DB::table('sub_categories as s')->join('products as p', 'p.subcategory_id', '=', 's.id')
            ->join('categories as c', 's.category_id', '=', 'c.id')->where('p.id', $product_id)
            ->select(
                'p.id as product_id',
                'p.product_name',
                's.id as sub_category_id',
                's.sub_category',
                'c.id as category_id',
                'c.category'
            )->first()
        ;
        if($table1->sub_category_id == $sub_category && $table1->category_id == $category){
            $product = DB::table('products')->where('id', $product_id)->first();
            return view('customer.productDetails' , [
                'product' => $product,
                'sub_category' => $table1->sub_category,
                'category' =>  $table1->category,
            ]);
        }

        dd('Failed');
        

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        
    }

public function search(Request $request)
{
    $term = trim($request->input('q', ''));
    $perPage = 8;
    $currentPage = (int) $request->input('page', 1);
    $offset = ($currentPage - 1) * $perPage;

    $categoryId = DB::table('categories')
        ->whereRaw('LOWER(category) = ?', [Str::lower($term)])
        ->value('id');

    $subCategoryId = DB::table('sub_categories')
        ->whereRaw('LOWER(sub_category) = ?', [Str::lower($term)])
        ->value('id');

    $base = DB::table('products as p')
        ->join('sub_categories as s', 'p.subcategory_id', '=', 's.id')
        ->join('categories as c', 's.category_id', '=', 'c.id')
        ->select(
            'p.id',
            'p.subcategory_id',
            's.category_id',
            'p.product_name',
            'p.description',
            'p.price',
            'p.stock_quatity',
            'p.image_url',
            'p.ratings',
            'p.previews'
        );

    if (!empty($categoryId)) {
        $base->where('s.category_id', $categoryId);
    } elseif (!empty($subCategoryId)) {
        $base->where('p.subcategory_id', $subCategoryId);
    } elseif ($term !== '') {
        $base->where('p.product_name', 'LIKE', "%{$term}%");
    } else {
        $base->whereRaw('1 = 0');
    }

    // IMPORTANT: count BEFORE applying skip/take
    $totalProducts = (clone $base)->count();
    $totalPages = max(1, (int) ceil($totalProducts / $perPage));

    // get only the page items
    $products = (clone $base)->orderBy('p.product_name')->skip($offset)->take($perPage)->get();

    // Pagination range logic (same as before)
    $startPage = max(1, $currentPage - 2);
    $endPage = min($totalPages, $currentPage + 2);

    if ($currentPage <= 2) {
        $endPage = min(5, $totalPages);
    }
    if ($currentPage >= $totalPages - 1) {
        $startPage = max(1, $totalPages - 4);
    }

    return view('customer.search', [
        'products' => $products,
        'currentPage' => $currentPage,
        'totalPages' => $totalPages,
        'startPage' => $startPage,
        'endPage' => $endPage,
        'searchTerm' => $term,
    ]);
}


public function autocomplete(Request $request)
{
    $term = trim($request->get('term', ''));
    if ($term === '') {
        return response()->json([]);
    }

    $limitPerType = 6;
    $like = '%' . $term . '%';

    $results = [];

    // 1) Categories (partial match)
    $cats = DB::table('categories')
        ->where('category', 'LIKE', $like)
        ->limit($limitPerType)
        ->pluck('category', 'id'); // [id => category_name]

    foreach ($cats as $id => $name) {
        $results[] = [
            'label' => $name,
            'type' => 'category',
            // search route will receive q param => category name
            'url' => route('products.search', ['q' => $name]),
        ];
    }

    // 2) Subcategories (partial match)
    $subs = DB::table('sub_categories')
        ->where('sub_category', 'LIKE', $like)
        ->limit($limitPerType)
        ->pluck('sub_category', 'id');

    foreach ($subs as $id => $name) {
        $results[] = [
            'label' => $name,
            'type' => 'subcategory',
            'url' => route('products.search', ['q' => $name]),
        ];
    }

    // 3) Products (partial match)
    $products = DB::table('products as p')
        ->where('p.product_name', 'LIKE', $like)
        ->select('p.id', 'p.product_name')
        ->limit(10)
        ->get();

    foreach ($products as $p) {
        // if you have a product detail route, generate it here. Replace 'products.show' if needed.
        // If you don't have a product detail route, omit url and we'll fill input + submit search.
        $productUrl = null;
        try {
            $productUrl = route('products.show', ['id' => $p->id]); // change route name as needed
        } catch (\Exception $e) {
            $productUrl = null;
        }

        $results[] = [
            'label' => $p->product_name,
            'type' => 'product',
            'id' => $p->id,
            'url' => $productUrl,
        ];
    }

    // Return JSON
    return response()->json($results);
}
}