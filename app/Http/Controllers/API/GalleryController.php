<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\GalleryResource;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GalleryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallery = Gallery::all();

        return $this->sendResponse(GalleryResource::collection($gallery), 'Gallery Images retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'images' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        Gallery::where('page_number',1)->delete();
        if(!empty($request->images)){
            foreach($request->images as $image){
                Gallery::create(
                    [
                        'description' => null,
                        'page_number' => 1,
                        'url' => $image
                    ]
                );
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function imageUpload(Request $request)
    {
        $files = $request->file('files');
        $fileURLs = [];
        $storagePath = 'public/media';

        foreach ($files as $file) {
            $fName = $this->generateRandomString();
            $filename = time() . '-' . $fName . '.' . $file->guessExtension();
            $url = Storage::disk('local')->putFileAs($storagePath, $file, $filename);
            $fileURLs[] = $url;
        }
        return response()->json(['status' => 'success', 'message' => 'file has been uploaded successfully', 'urls' => $fileURLs], 200);
    }

    private function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getStatistics(){
        $customers = User::all();
        $this->data['customers'] = $customers->count()-1;
        $products = Product::all();
        $this->data['products'] = $products->count();
        $orders = Order::all();
        $this->data['orders'] = $orders->count();
        $categories = Category::all();
        $this->data['categories'] = $categories->count();
        $todaysOrders = Order::whereDate('created_at', Carbon::today())->get();
        $this->data['todaysOrders'] = $todaysOrders->count();
        $pendingOrders = Order::where('status', 'unpaid')->get();
        $this->data['pendingOrders'] = $pendingOrders->count();
        return $this->data;
    }
}
