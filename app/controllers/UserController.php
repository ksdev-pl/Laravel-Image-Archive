<?php

class UserController extends Controller
{
    /**
     * Display a list of all Users
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();

        return View::make('user.index', compact('users'));
    }

    /**
     * Create new User
     *
     * @return \Illuminate\View\View | \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        if (Request::isMethod('GET')) {
            return View::make('user.create');
        }
        elseif (Request::isMethod('POST')) {
            $validator = Validator::make(Input::all(), User::$rules);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            User::create([
                'email' => Input::get('email'),
                'password' => Input::get('password'),
                'role' => Input::get('role')
            ]);

            return Redirect::to('/users')->with('success', 'User created');
        }
    }

    /**
     * Update User
     *
     * @param int $userId
     *
     * @return \Illuminate\View\View | \Illuminate\Http\RedirectResponse
     */
    public function update($userId)
    {
        $user = User::findOrFail($userId);

        if (Request::isMethod('GET')) {
            return View::make('user.update', compact('user'));
        }
        elseif (Request::isMethod('POST')) {
            if (Input::get('email') === $user->email) {
                $validator = Validator::make(Input::except('email'), User::$rules);
            }
            else {
                $validator = Validator::make(Input::all(), User::$rules);
            }

            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $user->update([
                'email' => Input::get('email'),
                'password' => Input::get('password'),
                'role' => Input::get('role')
            ]);

            return Redirect::to('/users')->with('success', 'User updated');
        }
    }

    /**
     * Delete User
     *
     * @param int $userId
     *
     * @return \Illuminate\View\View | \Illuminate\Http\RedirectResponse
     */
    public function delete($userId)
    {
        $user = User::findOrFail($userId);

        if (Request::isMethod('GET')) {
            return View::make('user.delete', compact('user'));
        }
        elseif (Request::isMethod('POST')) {
            $user->delete();

            return Redirect::to('/users')->with('success', 'User deleted');
        }
    }

    /**
     * Authenticate & sign User in
     *
     * @return \Illuminate\View\View | \Illuminate\Http\RedirectResponse
     */
    public function signIn()
    {
        if (Request::isMethod('GET')) {
            return View::make('signin');
        }
        elseif (Request::isMethod('POST')) {
            if (Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password')])) {
                return Redirect::intended('/categories');
            }
            else {
                return Redirect::back()->with('error', 'Incorrect email or password')->withInput();
            }
        }
    }

    /**
     * Sign User out
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function signOut()
    {
        Auth::logout();

        return Redirect::to('/signin')->with('success', 'Signed Out');
    }
}