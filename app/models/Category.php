<?php

class Category extends \Eloquent {

    /** @type array $rules  Validation rules */
    public static $rules = ['name' => 'required|min:3'];

    /** @type array $fillable  Fillable attributes */
    protected $fillable = ['name'];

    /**
     * Get related Albums
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function albums()
    {
        return $this->hasMany('Album');
    }

    /**
     * Delete Category & related Albums
     *
     * @return bool
     */
    public function delete()
    {
        $albums = $this->albums;
        foreach ($albums as $album) {
            $album->delete();
        }

        return parent::delete();
    }
}