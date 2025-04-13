<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product; // Giả sử bạn đã có model Product
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Function tra cứu sản phẩm theo mã vạch
    public function getProductInfo(Request $request)
    {
        // Lấy mã vạch từ frontend
        $barcode = $request->input('barcode');

        // Kiểm tra xem mã vạch có tồn tại trong cơ sở dữ liệu hay không
        $product = Product::where('barcode', $barcode)->first();

        // Nếu tìm thấy sản phẩm, trả về thông tin sản phẩm
        if ($product) {
            return response()->json([
                'status' => 'success',
                'product' => $product,
            ]);
        } else {
            // Nếu không tìm thấy, trả về thông báo lỗi
            return response()->json([
                'status' => 'error',
                'message' => 'Sản phẩm không tồn tại.',
            ]);
        }
    }
}
