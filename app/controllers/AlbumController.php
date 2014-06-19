<?php

class AlbumController extends Controller
{
    /**
     * Display a list of all Albums in Category
     *
     * @param int $categoryId
     *
     * @return \Illuminate\View\View
     */
    public function index($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $albums = $category->albums;

        return View::make('album.index', compact('category', 'albums'));
    }

    /**
     * Create a new Album
     *
     * @param int $categoryId
     *
     * @return \Illuminate\View\View | \Illuminate\Http\RedirectResponse
     */
    public function create($categoryId)
    {
        $category = Category::findOrFail($categoryId);

        if (Request::isMethod('GET')) {
            return View::make('album.create', compact('category'));
        }
        elseif (Request::isMethod('POST')) {
            $validator = Validator::make(Input::all(), Album::$rules);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            Album::create([
                'category_id' => $categoryId,
                'name' => Input::get('name')
            ]);

            return Redirect::to('/categories/' . $categoryId . '/albums')->with('success', 'Album created');
        }
    }

    /**
     * Update Album name
     *
     * @param int $categoryId
     * @param int $albumId
     *
     * @return \Illuminate\View\View | \Illuminate\Http\RedirectResponse
     */
    public function update($categoryId, $albumId)
    {
        $category = Category::findOrFail($categoryId);
        $album = Album::findOrFail($albumId);

        if (Request::isMethod('GET')) {
            return View::make('album.update', compact('category', 'album'));
        }
        elseif (Request::isMethod('POST')) {
            $validator = Validator::make(Input::all(), Album::$rules);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $album->update(['name' => Input::get('name')]);

            return Redirect::to('/categories/' . $categoryId . '/albums')->with('success', 'Album updated');
        }
    }

    /**
     * Delete Album & related Images
     *
     * @param int $categoryId
     * @param int $albumId
     *
     * @return \Illuminate\View\View | \Illuminate\Http\RedirectResponse
     */
    public function delete($categoryId, $albumId)
    {
        $category = Category::findOrFail($categoryId);
        $album = Album::findOrFail($albumId);

        if (Request::isMethod('GET')) {
            return View::make('album.delete', compact('category', 'album'));
        }
        elseif (Request::isMethod('POST')) {
            $album->delete();

            return Redirect::to('/categories/' . $categoryId . '/albums')->with('success', 'Album deleted');
        }
    }
}