<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Condition;
use App\Models\Item;
use App\Models\User;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ConditionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SellItemTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(CategorySeeder::class);
        $this->seed(ConditionSeeder::class);
    }

    public function test_user_can_sell_item_successfully()
    {
        Storage::fake('public');

        $user = User::factory()->create();

        $condition = Condition::first();
        $categoryIds = Category::take(2)->pluck('id')->toArray();

        $response = $this->actingAs($user)->post('/sell', [
            'category_ids' => $categoryIds,
            'condition_id' => $condition->id,
            'name' => 'テスト商品',
            'brand_name' => 'テストブランド',
            'description' => 'テスト用の商品説明です。',
            'price' => 5000,
            'image' => UploadedFile::fake()->create('test-item.jpg', 100, 'image/jpeg'),
        ]);

        $response->assertRedirect(route('profile.show'));
        $this->assertAuthenticatedAs($user);

        $this->assertDatabaseHas('items', [
            'user_id' => $user->id,
            'condition_id' => $condition->id,
            'name' => 'テスト商品',
            'brand_name' => 'テストブランド',
            'description' => 'テスト用の商品説明です。',
            'price' => 5000,
            'is_sold' => 0,
        ]);

        $item = Item::where('name', 'テスト商品')->first();

        $this->assertNotNull($item);
        Storage::disk('public')->assertExists($item->image);

        foreach ($categoryIds as $categoryId) {
            $this->assertDatabaseHas('item_category', [
                'item_id' => $item->id,
                'category_id' => $categoryId,
            ]);
        }
    }

    public function test_name_is_required_for_selling_item()
    {
        Storage::fake('public');

        $user = User::factory()->create();

        $condition = Condition::first();
        $categoryIds = Category::take(2)->pluck('id')->toArray();

        $response = $this->actingAs($user)->post('/sell', [
            'category_ids' => $categoryIds,
            'condition_id' => $condition->id,
            'name' => '',
            'brand_name' => 'テストブランド',
            'description' => 'テスト用の商品説明です。',
            'price' => 5000,
            'image' => UploadedFile::fake()->create('test-item.jpg', 100, 'image/jpeg'),
        ]);

        $response->assertSessionHasErrors(['name']);
    }

    public function test_price_is_required_for_selling_item()
    {
        Storage::fake('public');

        $user = User::factory()->create();

        $condition = Condition::first();
        $categoryIds = Category::take(2)->pluck('id')->toArray();

        $response = $this->actingAs($user)->post('/sell', [
            'category_ids' => $categoryIds,
            'condition_id' => $condition->id,
            'name' => 'テスト商品',
            'brand_name' => 'テストブランド',
            'description' => 'テスト用の商品説明です。',
            'price' => '',
            'image' => UploadedFile::fake()->create('test-item.jpg', 100, 'image/jpeg'),
        ]);

        $response->assertSessionHasErrors(['price']);
    }
}