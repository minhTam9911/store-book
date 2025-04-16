<?php

namespace App\Http\Controllers\Servers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    // Tìm kiếm sản phẩm (dùng cho Select2)
    public function search(Request $request)
    {
        $query = Product::query()->select(['id', 'name', 'price']);
    
    // Chỉ lọc khi có từ khóa tìm kiếm
    if ($request->has('q') && !empty(trim($request->q))) {
        $search = trim($request->q);
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%");
        });
    }
    
    // Sắp xếp và phân trang
    $products = $query->orderBy('name')->paginate(10);
    
    return response()->json([
        'data' => $products->items(),
        'next_page_url' => $products->nextPageUrl()
    ]);
    }
    
    // Lấy thông tin chi tiết các sản phẩm đã chọn
    public function getSelected(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:products,id'
        ]);
        
        $products = Product::whereIn('id', $request->ids)
            ->select(['id', 'name', 'price'])
            ->get();
            
        return response()->json([
            'data' => $products
        ]);
    }
    
    // Lưu danh sách sản phẩm đã chọn
    public function storeSelected(Request $request)
    {
        dd($request->all());
        $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'integer|exists:products,id'
        ]);
        
        
        // Xử lý lưu dữ liệu ở đây
        // Ví dụ: lưu vào session, database,...
        
        return response()->json([
            'success' => true,
            'message' => 'Đã lưu ' . count($request->product_ids) . ' sản phẩm'
        ]);
    }
}