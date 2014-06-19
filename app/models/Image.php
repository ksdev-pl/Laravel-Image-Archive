<?php

class Image extends \Eloquent
{
    /** @type array $rules  Validation rules */
    public static $rules = ['file' => 'mimes:jpeg,png,gif|max:2000'];

    /** @type array $fillable  Fillable attributes */
    protected $fillable = ['album_id', 'name', 'description'];

    /** @type array $touches  Relationships touched on save */
    protected $touches = ['album', 'category'];

    /** @type array $mimeTypes  Allowed extensions & related mime types */
    public static $mimeTypes = [
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif'
    ];

    /**
     * Get related Album
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function album()
    {
        return $this->belongsTo('Album');
    }

    /**
     * Get related Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->album->category;
    }

    /**
     * Show Image
     *
     * @param bool $thumb  Defaults to false. Set to true to show thumbnail
     *
     * @return \Illuminate\Http\Response
     */
    public function show($thumb = false) {
        if ($thumb) {
            $imagePath = storage_path() . '/files/thumbs/' . $this->name;
        }
        else {
            $imagePath = storage_path() . '/files/' . $this->name;
        }

        if (strtotime(Request::header('If-Modified-Since')) === File::lastModified($imagePath)) {
            $response = Response::make(null, 304);
        }
        else {
            $imageFile = File::get($imagePath);

            $fileExtension = pathinfo($this->name, PATHINFO_EXTENSION);
            if (isset(self::$mimeTypes[$fileExtension])) {
                $mimeType = self::$mimeTypes[$fileExtension];
            }
            else {
                $mimeType = 'application/octet-stream';
            }

            $response = Response::make($imageFile, 200);
            $response->header('Content-Type', $mimeType);
            $response->header('Last-Modified', gmdate('D, d M Y H:i:s T', File::lastModified($imagePath)));
        }

        $response->header('Expires', gmdate('D, d M Y H:i:s T', strtotime('+1 day')) );

        return $response;
    }

    /**
     * Delete Image
     *
     * @return bool
     */
    public function delete()
    {
        File::delete([
            storage_path() . '/files/' . $this->name,
            storage_path() . '/files/thumbs/' . $this->name
        ]);

        return parent::delete();
    }

    /**
     * Upload image
     *
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return string|false  Name of uploaded file or false if there was an error
     */
    public function upload($file) {
        $fileName = date("YmdHis").'-'.$this->slugify($file->getClientOriginalName());
        $destinationPath = storage_path() . '/files/';

        try {
            $file->move($destinationPath, $fileName);
            $this->createThumbnail($destinationPath, $fileName);
        }
        catch (Exception $exception) {
            Log::error($exception);

            return false;
        }

        return $fileName;
    }

    /**
     * Create thumbnail of image
     *
     * @param string $path  Path to file
     * @param string $filename  Filename
     */
    private function createThumbnail($path, $filename)
    {
        $image = ImageHandler::make($path . $filename);
        $image->fit(252, 252);
        $image->save($path . 'thumbs/' . $filename);
    }

    /**
     * Slugify image filename
     *
     * @param $fileName
     *
     * @return string
     */
    private function slugify($fileName) {
        $fileNameParts = pathinfo($fileName);
        $slugOfName = Str::slug($fileNameParts['filename']);
        $slugifiedFileName = $slugOfName . '.' . $fileNameParts['extension'];

        return $slugifiedFileName;
    }
}