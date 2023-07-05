<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Product;

class IMGController extends Controller
{
    public function uploadImage(Request $request)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $pin = mt_rand(100000, 999999)
        . mt_rand(100000, 999999);
    $random_string = str_shuffle($pin);

if($request->hasfile('image'))
{
    $file = $request->file('image');
    $file2 = $request->file('gallery');

    $imageName=time().$file->getClientOriginalName();
    $galleryName=time().$file2->getClientOriginalName();

    $filePath = 'uploads/' . $imageName;
    $filePath2 = 'uploads/' . $galleryName;

    Storage::disk('s3')->put($filePath, file_get_contents($file));
    Storage::disk('s3')->put($filePath2, file_get_contents($file2));
    // After Image is uploaded make entry to database
    // return "done";


    $imageUrl = $filePath;
    $galleryUrl = $filePath2;

// $completeUrl = 'https://goboss.s3.amazonaws.com/' . $imageUrl;

$completeUrl = [
    "id" => 477,
    "original" => 'https://goboss.s3.amazonaws.com/' . $imageUrl,
    "thumbnail" => 'https://goboss.s3.amazonaws.com/' . $imageUrl,
];

$completeGallery = [
    "id" => 477,
    "original" => 'https://goboss.s3.amazonaws.com/' . $galleryUrl,
    "thumbnail" => 'https://goboss.s3.amazonaws.com/' . $galleryUrl,
];

    $product = new Product();
    $product->name = $request->name;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->sale_price = $request->sale_price;
    $product->quantity = $request->quantity;
    $product->unit = $request->unit;
    $product->image = json_encode($completeUrl);
    $product->shop_id = $request->shop_id;
    $product->type_id = 1;
    $product->slug = $random_string;
    $product->gallery = json_encode($completeGallery);
    $product->save();
    return $product;

}
return response()->json('Successful');






    }
}


