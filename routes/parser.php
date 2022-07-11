<?php

//Route::get('', function () {
//    $res = Http::get('http://localhost:5000/categories')->json();
//    foreach ($res['data'] as $item) {
//        $contents = file_get_contents($item['image']);
//        $picture = md5($item['name']) . '.jpg';
//        Storage::disk('public')->put('pictures/' . $picture, $contents);
//        $category = new Category([
//            'title' => $item['name'],
//            'picture' => 'storage/pictures/' . $picture
//        ]);
//        $category->save();
//    }
//    $categories = [];
//    foreach (Category::all() as $item) {
//        $item['picture'] = asset($item['picture']);
//        $categories[] = $item;
//    }
//    return response()->json($categories);
//});

//use App\Models\Category\Category;
//use App\Models\Manufacturer\Manufacturer;
//use App\Models\Product\ProductsItem;
//use App\Models\Users\Role;
//use App\Models\Users\User;
//use Illuminate\Support\Facades\Route;
//
//Route::get('project_init', function () {
//    if (!User::all()->count()) {
//        $image_path = '/storage/pictures/1.jpg';
//        Role::create([
//            'title' => 'Administrator',
//            'slug' => 'admin'
//        ]);
//        $admin = User::create([
//            'name' => 'Administrator',
//            'email' => 'admin@admin.com',
//            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
//        ]);
//        $admin->roles()->attach(1);
//        shell_exec('php ../artisan passport:install');
//        Category::create([
//            'category_id' => null,
//            'title' => 'Category',
//            'image' => $image_path
//        ]);
//        Manufacturer::create([
//            'title' => 'Manufacturer',
//            'image' => $image_path
//        ]);
//        ProductsItem::create([
//            'title' => 'Product 1',
//            'description' => 'Product 1 description',
//            'category_id' => 1,
//            'user_id' => 1,
//            'manufacturer_id' => 1
//        ]);
//
//        return response()->json(['message' => 'Create database!']);
//    }
//    $data = ProductsItem::all();
//    return response()->json(['data' => $data]);
//});