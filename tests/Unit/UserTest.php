<?php

namespace Tests\Unit;

use App\Http\Controllers\CategoryController;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {

        $demo_cateId = 11;
        $beforeRemoveCount = Product::where('cate_id', $demo_cateId)->count();
        $ctr = new CategoryController();
        $ctr->removeCate($demo_cateId);

        $afterRemoveCount = Product::where('cate_id', $demo_cateId)->count();

        $this->assertNotEquals($beforeRemoveCount, $afterRemoveCount, "Trước khi xóa: $beforeRemoveCount, sau khi xóa: $afterRemoveCount");
        $this->assertEquals(0, $afterRemoveCount, "Kiểm tra sau khi xóa có bằng 0 hay không?");
    }
}
