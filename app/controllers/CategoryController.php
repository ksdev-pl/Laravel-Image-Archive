<?php

class CategoryController extends Controller
{
    /**
	 * Display a list of all Categories
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
        $categories = Category::all();

		return View::make('category.index', compact('categories'));
	}

	/**
	 * Create a new Category
	 *
	 * @return \Illuminate\View\View | \Illuminate\Http\RedirectResponse
	 */
	public function create()
	{
		if (Request::isMethod('GET')) {
            return View::make('category.create');
        }
        elseif (Request::isMethod('POST')) {
            $validator = Validator::make(Input::all(), Category::$rules);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            Category::create(['name' => Input::get('name')]);

            return Redirect::to('/categories')->with('success', 'Category created');
        }
	}

	/**
	 * Update Category name
	 *
	 * @param int $categoryId
     *
	 * @return \Illuminate\View\View | \Illuminate\Http\RedirectResponse
	 */
	public function update($categoryId)
	{
        $category = Category::findOrFail($categoryId);

		if (Request::isMethod('GET')) {
            return View::make('category.update', compact('category'));
        }
        elseif (Request::isMethod('POST')) {
            $validator = Validator::make(Input::all(), Category::$rules);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $category->update(['name' => Input::get('name')]);

            return Redirect::to('/categories')->with('success', 'Category updated');
        }
	}

	/**
	 * Delete Category, related Albums & Images
	 *
	 * @param int $categoryId
     *
	 * @return \Illuminate\View\View | \Illuminate\Http\RedirectResponse
	 */
	public function delete($categoryId)
	{
        $category = Category::findOrFail($categoryId);

        if (Request::isMethod('GET')) {
            return View::make('category.delete', compact('category'));
        }
        elseif (Request::isMethod('POST')) {
            $category->delete();

            return Redirect::to('/categories')->with('success', 'Category deleted');
        }
	}
}
