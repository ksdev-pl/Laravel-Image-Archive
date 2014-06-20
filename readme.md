Laravel Image Archive
=====================
__Simple and secure archive for images:__

* Create multiple categories with multiple albums with multiple images!
* Manage multiple users with different privileges!
* Easily navigate between all those things!

The purpose of this project was for internal use of a company, so no big effort went into the presentation - it's simple and clean bootstrap ready for further improvements.

![Laravel Image Archive](https://dl.dropboxusercontent.com/s/pvj8cyagqo0165o/laravel-image-archive-1.png)
![Laravel Image Archive](https://dl.dropboxusercontent.com/s/o2diyvioy8f4gli/laravel-image-archive-2.png)

##### Dependencies
* PHP 5.4 (short array syntax)
* [__Laravel Framework:__](https://github.com/laravel/framework) 4.2.*
* [__Intervention Image:__](https://github.com/Intervention/image) 2.*
* [__DropzoneJS:__](https://github.com/enyo/dropzone) 3.10.2
* [__DataTables:__](https://github.com/DataTables/DataTables) 1.10.0
* [__Twitter Bootstrap:__](https://github.com/twbs/bootstrap) 3.1.1
* [__Magnific Popup:__](https://github.com/dimsemenov/Magnific-Popup) 0.9.9

##### Installation
* `git clone https://github.com/ksdev-pl/Laravel-Image-Archive.git`
* `composer install`
* Configure database connection in `/app/config/database.php`
* `php artisan migrate`
* Point web root to `/public` folder, the rest should be protected
* Folders within `/app/storage` require write access by the web server
* Sign in with email: `admin@admin.com` and password: `admin`
* Create new user with admin privileges and delete default account

##### Things to know
* If you wish to change file types that users are allowed to upload, update `$rules` and `$mimeTypes` in the `Image` model
* In `Image` model `$rules` you can also change max file size
* User roles and corresponding privileges:
  * Restricted - upload only
  * Normal - upload, edit & delete
  * Admin - manage users

##### License
Laravel Image Archive is released under the [MIT license](http://opensource.org/licenses/MIT).