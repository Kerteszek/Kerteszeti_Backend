    <?php

    use App\Http\Controllers\BasketController;
    use App\Http\Controllers\BasketItemController;
    use App\Http\Controllers\PictureController;
    use App\Http\Controllers\PlantController;
    use App\Http\Controllers\ProductController;
    use App\Http\Controllers\PurchaseItemController;
    use App\Http\Controllers\SupplianceController;
    use App\Http\Controllers\UserController;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
    */

    Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
        return $request->user();
    });


    //felhasználó réteg (regisztálva, bejelentkezve)
    Route::middleware(['auth.basic'])->group(function () {


        Route::middleware(['admin'])->group(function () {
            //elérheti az admin, és a superAdmin
            Route::apiResource('/users', UserController::class);
            //Termék Update és Patch
            Route::patch('products/{product_id}', [ProductController::class, 'update']);
            Route::post('products', [ProductController::class, 'store']);

            Route::patch('plants/{scientific_name}', [PlantController::class, 'update']);
            Route::post('plants', [PlantController::class, 'store']);
        });

        Route::middleware(['superadmin'])->group(function () {
            //Csak a superadmin érheti el
            //Route::delete('/products/{product_id}', [PlantController::class, 'destroy']);
            Route::get('users', [UserController::class, 'index']);

            Route::delete('/user_delete/{user_id}', [UserController::class, 'destroy']);
        });
    });

    //felhasználó réteg (regisztráció nélkül)
    Route::get('products', [ProductController::class, 'index']);

    //Termék összes frontendremenő adata
    Route::get('product_frontend', [ProductController::class, 'frontendTermek']);
    //frontendTermekKeppel
    Route::get('product_w_pictures', [ProductController::class, 'frontendTermekKeppel']);
    
    Route::get('konkret_product/{product_id}', [ProductController::class, 'konkretTermekKeppel']);
    //boritoKep
    Route::get('boritokep', [ProductController::class, 'boritoKep']);

    //Képek elérési útja
    Route::get('pictures', [PictureController::class, 'index']);


    //Trigger útvonalak teszthez

    //Pucchase Item  útvonalak, átszervezni majd adminokhoz
    Route::get('purchase_items', [PurchaseItemController::class, 'index']);
    Route::get('purchase_items/{purchase_number}/{product_id}', [PurchaseItemController::class, 'show']);
    Route::patch('purchase_items/{purchase_number}/{product_id}', [PurchaseItemController::class, 'update']);
    Route::post('purchase_items', [PurchaseItemController::class, 'store']);
    Route::delete('puritem_delete/{purchase_number}/{product_id}', [PurchaseItemController::class, 'destroy']);

    //New stock  (suppliance)
    Route::get('suppliances', [SupplianceController::class, 'index']);
    Route::get('suppliances/{product}/{suppliance_date}', [SupplianceController::class, 'show']);
    //Route::patch('suppliances/{product}/{suppliance_date}', [SupplianceController::class, 'update']);
    Route::post('suppliances', [SupplianceController::class, 'store']);
    Route::delete('suppliance_delete/{product}/{suppliance_date}', [SupplianceController::class, 'destroy']);


    //Termék  végpontok
    Route::get('products', [ProductController::class, 'index']);
    Route::get('products/{product_id}', [ProductController::class, 'show']);
    Route::patch('products/{product_id}', [ProductController::class, 'update']);
    Route::post('products', [ProductController::class, 'store']);
    //Route::delete('products_delete/{product_id}', [ProductController::class, 'destroy']);

    //Basket végpontok
    Route::get('baskets', [BasketController::class, 'index']);
    Route::get('baskets/{basket_id}', [BasketController::class, 'show']);
    Route::patch('baskets/{basket_id}', [BasketController::class, 'update']);
    Route::post('baskets', [BasketController::class, 'store']);
    //Route::delete('baskets_delete/{basket_id}', [BasketController::class, 'destroy']);
    //Basket Item
    Route::get('basket_items', [BasketItemController::class, 'index']);
    Route::get('basket_items/{product}/{basket}', [BasketItemController::class, 'show']);
    Route::patch('basket_items/{product}/{basket}', [BasketItemController::class, 'update']);
    Route::post('basket_item', [BasketItemController::class, 'store']);
    Route::delete('basket_items_delete/{product}/{basket}', [BasketItemController::class, 'destroy']);
