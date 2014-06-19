<?php

class ImageController extends Controller
{
    /**
     * Display a list of all Images in Album
     *
     * @param int $categoryId
     * @param int $albumId
     *
     * @return Response
     */
    public function index($categoryId, $albumId)
    {
        $category = Category::findOrFail($categoryId);
        $album = Album::findOrFail($albumId);
        $images = $album->images;

        return View::make('image.index', compact('category', 'album', 'images'));
    }

    /**
     * Show Image & thumbnail
     *
     * Shows thumbnail when URL parameter "thumb" is set
     *
     * @param $categoryId
     * @param $albumId
     * @param $imageId
     *
     * @return \Illuminate\Http\Response
     */
    public function show($categoryId, $albumId, $imageId)
    {
        $image = Image::findOrFail($imageId);

        if (Input::has('thumb')) {
            return $image->show(true);
        }
        else {
            return $image->show();
        }
    }

    /**
     * Upload & store new images
     *
     * @param int $categoryId
     * @param int $albumId
     *
     * @return \Illuminate\View\View | \Illuminate\Http\Response | \Illuminate\Http\JsonResponse
     */
    public function create($categoryId, $albumId)
    {
        $category = Category::findOrFail($categoryId);
        $album = Album::findOrFail($albumId);

        if (Request::isMethod('GET')) {
            return View::make('image.create', compact('category', 'album'));
        }
        elseif (Request::isMethod('POST')) {
            $validator = Validator::make(Input::all(), Image::$rules);
            if ($validator->fails()) {
                return Response::make($validator->errors()->first(), 403);
            }

            $image = new Image();
            $uploadedFileName = $image->upload(Input::file('file'));

            if ($uploadedFileName) {
                Image::create([
                    'album_id' => $albumId,
                    'name' => $uploadedFileName
                ]);

                return Response::json('OK', 200);
            }
            else {
                return Response::json('Internal Server Error', 500);
            }
        }
    }

    /**
     * Update Image description
     *
     * @param int $categoryId
     * @param int $albumId
     * @param int $imageId
     *
     * @return \Illuminate\View\View | \Illuminate\Http\RedirectResponse
     */
    public function update($categoryId, $albumId, $imageId)
    {
        $category = Category::findOrFail($categoryId);
        $album = Album::findOrFail($albumId);
        $image = Image::findOrFail($imageId);

        if (Request::isMethod('GET')) {
            return View::make('image.update', compact('category', 'album', 'image'));
        }
        elseif (Request::isMethod('POST')) {
            $image->update(['description' => Input::get('description')]);

            return Redirect::to('/categories/' . $categoryId . '/albums/' . $albumId . '/images')
                ->with('success', 'Image updated');
        }
    }

    /**
     * Delete Image
     *
     * @param int $categoryId
     * @param int $albumId
     * @param int $imageId
     *
     * @return \Illuminate\View\View | \Illuminate\Http\RedirectResponse
     */
    public function delete($categoryId, $albumId, $imageId)
    {
        $category = Category::findOrFail($categoryId);
        $album = Album::findOrFail($albumId);
        $image = Image::findOrFail($imageId);

        if (Request::isMethod('GET')) {
            return View::make('image.delete', compact('category', 'album', 'image'));
        }
        elseif (Request::isMethod('POST')) {
            $image->delete();

            return Redirect::to('/categories/' . $categoryId . '/albums/' . $albumId . '/images')
                ->with('success', 'Image deleted');
        }
    }

}