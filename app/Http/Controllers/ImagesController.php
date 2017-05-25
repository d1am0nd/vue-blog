<?php

namespace App\Http\Controllers;

use App\Models\Image\Image;
use Illuminate\Http\Request;
use App\Http\Requests\Images\CreateRequest;

class ImagesController extends Controller
{
    protected $image;

    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    public function postNew(CreateRequest $request)
    {
        $folder = '/assets/images';
        $name = $this->saveToFolder($request->file('image'), $folder, $image->getClientOriginalName());
        $image = $this->image->createFromArray([
            'user_id' => Auth::user()->id,
            'name' => $request->input('name'),
            'path' => $folder . '/' . $name
        ]);
        return response()->json($image);
    }

    private function saveToFolder($image, $folder, $name)
    {
        if(!File::exists(public_path($folder))) {
            if(!File::makeDirectory(public_path($folder), 0775, true)) {
                throw new \Exception("Cant create folder $folder");
            }
        }

        $index = 0;
        $newName = $name;
        do {
            if($index !== 0) {
                $newName = $index . $name;
            }
            $index += 1;
        } while (File::exists(public_path($folder . '/' . $newName)));
        $filePath = $folder . '/' . $newName;

        $img = Image::make($image);
        $img->save(public_path($filePath));

        return $newName;
    }
}
