<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CategoryController extends Controller
{
    function getAll() {
        $list = Categories::all();
        return response()->json($list,200,['Charset'=>'utf-8']);
    }

    function create(Request $request) {
        $input = $request->all(); //отримуємо із запита усі інпути
        $image = $request->file("image"); //отримуємо із запита фото
        $manager = new ImageManager(new Driver()); //менеджер для фото
        $imageName = uniqid().".webp";
        $sizes = [50,150,300,600,1200];
        foreach ($sizes as $size) {
            $imageSave = $manager->read($image);
            $imageSave->scale(width: $size);
            $path = public_path("upload/".$size."_".$imageName);
            $imageSave->toWebp()->save($path);
        }
        $input["image"]=$imageName;
        $category = Categories::create($input);
        return response()->json($category,200,['Charset'=>'utf-8']);
    }
}
