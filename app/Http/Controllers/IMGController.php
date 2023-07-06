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
        $pin = mt_rand(100000, 999999) . mt_rand(100000, 999999);
        $random_string = str_shuffle($pin);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . $file->getClientOriginalName();
            $filePath = 'uploads/' . $imageName;

            try {
                Storage::disk('s3')->put($filePath, file_get_contents($file));
                $imageUrl = $filePath;

                // Insert the image URL into the database or perform other operations

$completeUrl = 'https://goboss-ng.s3.amazonaws.com/' . $imageUrl;

$completeUrl = [
    "id" => 477,
    "original" => 'https://goboss-ng.s3.amazonaws.com/' . $imageUrl,
    "thumbnail" => 'https://goboss-ng.s3.amazonaws.com/' . $imageUrl,
];

$completeGalleryUrl = 'https://goboss-ng.s3.amazonaws.com/' . $imageUrl;

$completeGalleryUrl = [
    "id" => 477,
    "original" => 'https://goboss-ng.s3.amazonaws.com/' . $imageUrl,
    "thumbnail" => 'https://goboss-ng.s3.amazonaws.com/' . $imageUrl,
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
    $product->gallery = json_encode($completeGalleryUrl);
    $product->save();
    return $product;

                return response()->json('Successful');
            } catch (\Exception $e) {
                // Error occurred while uploading the image
                return response()->json('Failed to upload image to S3', 500);
            }
        }

        // No image file found in the request
        return response()->json('Image file not provided', 400);
    }
}
