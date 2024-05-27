<?php

namespace App\Casts;

use Illuminate\Support\Str;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class Image implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get($model, $key, $value, $attributes)
    {
        if (Str::startsWith($value, 'http')) {
            return $value;
        }
        $images = json_decode($value);
        $path   = request()->getSchemeAndHttpHost() . '/image/';
        if ($images && is_array($images)) {
            $data = [];
            foreach ($images as $image) {
                if (!empty($image)) {
                    $data[] = $path . $image;
                }
            }
            return $data;
        }
        if (!empty($value)) {
            return $path . $value;
        }
        return request()->getSchemeAndHttpHost() . '/images/logo.jpg';
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set($model, $key, $value, $attributes)
    {
        return $value;
    }
}
