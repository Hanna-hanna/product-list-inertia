<?php

namespace App\Domains\Products\Http\Controllers;

use App\Domains\Products\Actions\DeleteProduct;
use App\Domains\Products\Actions\StoreProduct;
use App\Domains\Products\Actions\UpdateProduct;
use App\Domains\Products\Http\Requests\ProductRequest;
use App\Domains\Products\Http\Resources\ProductResource;
use App\Domains\Products\Models\Eloquent\Product;
use App\Exceptions\ApiHttpException;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }

        // Sort by rank by default
        $products = $query->orderBy('rank')->paginate(10);

        return Inertia::render('Products/List', [
            'products' => ProductResource::collection($products),
        ]);
    }


    /**
     * @param ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            /* @var StoreProduct $storeProduct */
            app(StoreProduct::class)->execute($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return redirect()->route('products.index');
    }


    /**
     * @return Response
     */
    public function create()
    {
        return Inertia::render('Products/Create');
    }

    /**
     * @param Product $product
     * @return Response
     */
    public function edit(Product $product)
    {
        $product = new ProductResource($product);
        return Inertia::render('Products/Edit', [
            'product' => new ProductResource($product)
        ]);
    }

    /**
     * @param Product $product
     * @return Response
     */
    public function show(Product $product)
    {
        $product = new ProductResource($product);
        return Inertia::render('Products/Edit', [
            'product' => new ProductResource($product)
        ]);
    }



    /**
     * @param ProductRequest $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductRequest $request, Product $product)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            /* @var UpdateProduct $updateProduct */
            app(UpdateProduct::class)->execute($product, $data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return redirect()->route('products.index');
    }


    /**
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        /* @var DeleteProduct $deleteProduct */
        app(DeleteProduct::class)->execute($product);

        return redirect()->route('products.index');
    }
}
