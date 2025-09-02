<?php

namespace App\Http\Controllers\orm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductImage;

class ImageController extends Controller
{
    //     if($request->hasFile('extra_images')){
    //     foreach ($request->file('extra_images') as $file) {
    //         $url = Cloudinary::upload($file->getRealPath(), [
    //             'folder' => 'products/' . $product->id
    //         ])->getSecurePath();

    //         ProductImage::create([
    //             'product_id' => $product->id,
    //             'url' => $url
    //         ]);
    //     }
    // }

}
