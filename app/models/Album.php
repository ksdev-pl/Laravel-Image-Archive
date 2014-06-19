<?php

class Album extends \Eloquent
{
    /** @type array $rules  Validation rules */
    public static $rules = ['name' => 'required|min:3'];

    /** @type array $fillable  Fillable attributes */
    protected $fillable = ['category_id', 'name'];

    /** @type array $touches  Relationships touched on save */
    protected $touches = ['category'];

    /**
     * Get related Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('Category');
    }

    /**
     * Get related Images
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany('Image');
    }

    /**
     * Delete Album & related Images
     *
     * @return bool
     */
    public function delete()
    {
        $images = $this->images;
        foreach($images as $image) {
            $image->delete();
        }

        return parent::delete();
    }
}