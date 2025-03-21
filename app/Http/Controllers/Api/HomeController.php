<?php
namespace App\Http\Controllers\API;
 
use Validator;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use Laravel\Sanctum\HasApiTokens; 

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\RestaurantCategory;
use App\Models\Websiteconfig;
use Route;
use Hash;
use DB;

class HomeController extends Controller
{
    public $token = true;
	public function __construct()
    {	
		
    }	
	
	public function webconfig()
	{
		$website = Websiteconfig::first(); 
		$arraystore = array(
			'appVersion'=> $website->app_version,
			'maintainanceMode'=> $website->maintainance_mode,
			'assetUrl' => 'https://caterer.gainenterprises.in/backend/',
		);
		return response()->json(['success' => true,'message' => 'data found', 'data'=>$arraystore], 200);
	}
	
	public function forgotPassword(Request $request)
	{
    	$validator = Validator::make($request->all(), 
        [
            'email' => 'required|email',
        ]);
        if ($validator->fails())
            return response()->json(['success' => false, 'errorcode' => '03', 'message' => $validator->errors()->first(), 'data' => []], 200);
        else
        {
            $email = $request->input('email');
            
            $user = User::where('email', $email)->first();
            if($user)
            {
                $otp = rand(100000,999999);
                $user->password = Hash::make($otp);
                $user->save();
                
                $from = "no_reply@gainenterprises.com";
                $subject = "Forget password gain enterprises";
                $headers = "From: $from" . "\r\n" .
                           "Reply-To: $from" . "\r\n" .
                           "X-Mailer: PHP/" . phpversion();
                
                $body = "Your gain enterprises new password is ".$otp;
              
                if(mail($email, $subject, $body, $headers))
                    return response()->json(['success' => true,'errorcode'=>'00','message' => 'New password sent to the registered email id.', 'data'=>[]], 200);
                else
                    return response()->json(['success' => false,'errorcode'=>'04', 'message'=>'No user found with this email!', 'data'=>array()], 200);
            }
            else
                return response()->json(['success' => false,'errorcode'=>'04', 'message'=>'No user found with this email!', 'data'=>array()], 200);
        }
	}
	
	public function getAllRestaurantByCategoryId(Request $request)
	{
	    $validator = Validator::make($request->all(), 
        [
            'categoryId' => 'required',
        ]);
    
        if ($validator->fails())
            return response()->json(['success' => false, 'errorcode' => '03', 'message' => $validator->errors()->first(), 'data' => []], 200);
        else
        {
            $restaurant = RestaurantCategory::with(['restaurant' => function ($query) {
                $query->select('id', 'name', 'image', 'rating', 'availability');
            }])
            ->select('id', 'restaurant_id') 
            ->Where('status','A')
            ->where('category_id', $request->categoryId)
            ->orderBy('id', 'DESC')
            ->get();
    		if($restaurant->isNotEmpty())
    			return response()->json(['success' => true,'errorcode'=>'00','message' => 'data found', 'data'=>$restaurant], 200);
    		else
    			return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'No data found!', 'data'=>array()], 200);
        }
	    
	}
	
	public function getAllRestaurant(Request $request)
	{
	    $restaurant = Restaurant::Where('status','A')->orderBy('id', 'DESC')->get(['id', 'name', 'image', 'rating', 'availability']); 
		if($restaurant->isNotEmpty())
			return response()->json(['success' => true,'errorcode'=>'00','message' => 'data found', 'data'=>$restaurant], 200);
		else
			return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'No data found!', 'data'=>array()], 200);
	}
	
	
	public function getAllProductByRestaurantIdWithFilter(Request $request)
	{
        //$userid = auth()->user()->id;
	  // $userid = 1;
      // echo __DIR__;
      // dd($request->query('restaurantId'), $request->query('table_id'));



        $validator = Validator::make($request->query(),  
        [
            'restaurantId' => 'required',
            'table_id' => 'required', 
            'user_id' => 'required', 
        ]);
    
        if ($validator->fails())
            return response()->json(['success' => false, 'errorcode' => '03', 'message' => $validator->errors()->first(), 'data' => []], 200);
        else
        {
            DB::table('user_restaurant_tables')
            ->updateOrInsert(
                ['user_id' => $request->user_id, 'restaurant_id' => $request->restaurantId], // Search condition
                ['table_id' => $request->table_id, 'updated_at' => now()] // Values to update or insert
            );

            $query = Restaurant::with('categories.category.products')->where('status', 'A');
            
            $restaurant = $query->where('id', $request->restaurantId)->first();
        
            if (!$restaurant) {
                return response()->json(['success' => false, 'errorcode' => '03', 'message' => 'No data found!', 'data' => []], 200);
            }
        
            $categories = $restaurant->categories->sortByDesc('category_id');
        
            $staticCategory = [
                'category_id' => 0,
                'category_name' => 'All',
                'icon' => NULL,
            ];
        
            $formattedRestaurant = [
                'id' => $restaurant->id,
                'name' => $restaurant->name,
                'image' => $restaurant->image,
                'rating' => $restaurant->rating,
                'availability' => $restaurant->availability,
                'categories' => collect([$staticCategory])
                    ->merge($categories->map(function ($restaurantCategory) {
                        return [
                            'category_id' => $restaurantCategory->category->id,
                            'category_name' => $restaurantCategory->category->name,
                            'icon' => $restaurantCategory->category->icon,
                        ];
                    }))
                    ->values(),
                'products' => $categories->flatMap(function ($restaurantCategory) use ($request) {
                    if ($request->categoryId && $restaurantCategory->category_id == $request->categoryId) {
                        return $restaurantCategory->category->products->map(function ($product) {
                            return [
                                'product_id' => $product->id,
                                'product_name' => $product->name,
                                'product_image' => $product->image,
                                'price' => $product->price,
                                'description' => $product->description,
                            ];
                        });
                    } elseif (!$request->categoryId) {
                        return $restaurantCategory->category->products->map(function ($product) {
                            return [
                                'product_id' => $product->id,
                                'product_name' => $product->name,
                                'product_image' => $product->image,
                                'price' => $product->price,
                                'description' => $product->description,
                            ];
                        });
                    }
                    return []; 
                }),
            ];
            return response()->json(['success' => true, 'errorcode' => '00', 'message' => 'data found', 'data' => $formattedRestaurant], 200);
        }
	}
	
	
	public function searchProductOrRestaurant(Request $request)
	{
        $validator = Validator::make($request->all(), 
        [
            'query' => 'required|string|max:255',
        ]);
    
        if ($validator->fails())
            return response()->json(['success' => false, 'errorcode' => '03', 'message' => $validator->errors()->first(), 'data' => []], 200);
        else
        {
            $query = $request->input('query');
            
            $data = [
                'category' =>  Category::where('name', 'like', '%' . $query . '%')->get(['id', 'name', 'icon']),
                'restaurant' => Restaurant::where('name', 'like', '%' . $query . '%')->get(['id', 'name', 'image', 'rating', 'availability'])
            ];
            if($data)
                return response()->json(['success' => true,'errorcode'=>'00','message' => 'data found', 'data'=>$data], 200);
    		else
    			return response()->json(['success' => false,'errorcode'=>'04', 'message'=>'No product found!', 'data'=>array()], 200);
        }
	}
	
	public function getRecommendedProduct(Request $request)
	{
        $product = Product::where('is_recommend', 'YES')->where('status', 'A')->get(['id', 'name', 'image', 'description', 'price']);
        if($product->isNotEmpty())
            return response()->json(['success' => true,'errorcode'=>'00','message' => 'data found', 'data'=>$product], 200);
		else
			return response()->json(['success' => false,'errorcode'=>'04', 'message'=>'No product found!', 'data'=>array()], 200);
	}
	
	public function getAllCategories()
	{
	    $category = Category::Where('status','A')->orderBy('id', 'DESC')->get(['id', 'name', 'icon']); 
		if($category->isNotEmpty())
			return response()->json(['success' => true,'errorcode'=>'00','message' => 'data found', 'data'=>$category], 200);
		else
			return response()->json(['success' => false,'errorcode'=>'04', 'message'=>'No data found!', 'data'=>array()], 200);
	}
	
	public function getAllProductByCategoryId(Request $request) 
	{
		$validator = Validator::make($request->all(), 
		[
            'categoryId' => 'required',
		]);
		if ($validator->fails()) {
			return response()->json(['success' => false,'errorcode'=>'04', 'message'=>$validator->errors()->first(), 'data'=>array()], 200);			
		} else {
			$product = Product::Where('status','A')->where('category_id', $request->categoryId)->orderBy('id', 'DESC')->get(['id', 'name', 'image', 'description', 'price']); 
    		if($product->isNotEmpty())
    			return response()->json(['success' => true,'errorcode'=>'00','message' => 'data found', 'data'=>$product], 200);
    		else
    			return response()->json(['success' => false,'errorcode'=>'04', 'message'=>'No Product found!', 'data'=>array()], 200);
		}
	}
}