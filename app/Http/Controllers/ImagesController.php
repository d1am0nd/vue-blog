<?php

namespace App\Http\Controllers;

use Auth;
use File;
use App\Models\Image\Image as ImageModel;
use App\Lib\Upload\Image;
use Illuminate\Http\Request;
use App\Http\Requests\Images\CreateRequest;

class ImagesController extends Controller
{
    protected $image, $imageUpload, $folder;

    public function __construct(ImageModel $image, Image $imageUpload)
    {
        $this->image = $image;
        $this->imageUpload = $imageUpload;
        $this->folder = '/assets/images';
    }

    public function postNew(CreateRequest $request)
    {
        $image = $request->input('image');
        $name = $request->input('name');

        $name = $this->imageUpload->uploadToDir($image, $this->folder, $name);
        $image = $this->image->createFromArray([
            'name' => $name,
            'path' => $this->folder . '/' . $name
        ], Auth::user()->id);
        return response()->json($image);
    }

    public function postEdit(CreateRequest $request, $id)
    {
        $image = $this->image->byId($id)->firstOrFail();
        if ($request->has('name')) {
            $image->name = $request->name;
        }
        if ($request->has('image') && $request->input('image') !== $image->image) {
            $this->imageUpload->deleteIfExists($image->path);
            $name = $this->imageUpload->uploadToDir($request->input('image'), $this->folder, $image->name);
            $image->path = $this->folder . '/' . $name;
        }
        $image->save();
        return response()->json(['image' => $image]);
    }

    public function deleteById(Request $request, $id)
    {
        $image = $this->image->byId($id)->firstOrFail();
        $this->imageUpload->deleteIfExists($image->path);
        return response()->json($image->delete());
    }

    public function getImages(Request $request)
    {
        return response()->json($this->image->get());
    }

    public function getById(Request $request, $id)
    {
        return response()->json($this->image->byId($id)->firstOrFail());
    }
}
