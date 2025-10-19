<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/products",
     *     summary="Menampilkan daftar produk",
     *     tags={"Products"},
     *     @OA\Response(
     *         response=200,
     *         description="Daftar produk berhasil diambil",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Cappuccino"),
     *                 @OA\Property(property="description", type="string", example="Kopi dengan susu dan foam"),
     *                 @OA\Property(property="price", type="number", format="float", example=25.000),
     *                 @OA\Property(property="image", type="string", example="https://example.com/image.jpg"),
     *                 @OA\Property(property="best_seller", type="boolean", example=true),
     *                 @OA\Property(property="category_id", type="integer", example=2),
     *                 @OA\Property(property="category_name", type="string", example="Coffee")
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        // Ambil semua produk beserta kategori-nya
        $products = Product::with('category')->get();

        // Format agar kategori juga tampil rapi di response
        $data = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'image' => $product->image,
                'best_seller' => $product->best_seller,
                'category_id' => $product->category_id,
                'category_name' => $product->category ? $product->category->name : null,
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Daftar produk berhasil diambil',
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/products",
     *     tags={"Products"},
     *     summary="Tambah produk baru",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","price","category_id"},
     *             @OA\Property(property="name", type="string", example="Espresso"),
     *             @OA\Property(property="description", type="string", example="Kopi hitam pekat tanpa gula"),
     *             @OA\Property(property="price", type="number", format="float", example=18.000),
     *             @OA\Property(property="category_id", type="integer", example=1),
     *             @OA\Property(property="image", type="string", example="https://example.com/image.jpg"),
     *             @OA\Property(property="best_seller", type="boolean", example=false)
     *         )
     *     ),
     *     @OA\Response(response=201, description="Produk berhasil ditambahkan")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|string',
            'best_seller' => 'boolean',
        ]);

        $product = Product::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan',
            'data' => $product
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/products/{id}",
     *     tags={"Products"},
     *     summary="Menampilkan detail produk berdasarkan ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Detail produk berhasil diambil"),
     *     @OA\Response(response=404, description="Produk tidak ditemukan")
     * )
     */
    public function show($id)
    {
        $product = Product::with('category')->find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail produk berhasil diambil',
            'data' => $product
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/products/{id}",
     *     tags={"Products"},
     *     summary="Update data produk",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Latte"),
     *             @OA\Property(property="description", type="string", example="Kopi dengan susu lembut"),
     *             @OA\Property(property="price", type="number", format="float", example=25.000),
     *             @OA\Property(property="category_id", type="integer", example=1),
     *             @OA\Property(property="image", type="string", example="https://example.com/new-image.jpg"),
     *             @OA\Property(property="best_seller", type="boolean", example=true)
     *         )
     *     ),
     *     @OA\Response(response=200, description="Produk berhasil diperbarui"),
     *     @OA\Response(response=404, description="Produk tidak ditemukan")
     * )
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'category_id' => 'sometimes|required|exists:categories,id',
            'image' => 'nullable|string',
            'best_seller' => 'boolean',
        ]);

        $product->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil diperbarui',
            'data' => $product
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/products/{id}",
     *     tags={"Products"},
     *     summary="Hapus produk berdasarkan ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Produk berhasil dihapus"),
     *     @OA\Response(response=404, description="Produk tidak ditemukan")
     * )
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus'
        ]);
    }
}
