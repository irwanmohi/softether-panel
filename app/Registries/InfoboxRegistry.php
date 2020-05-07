<?php

namespace App\Registries;

use App\Contracts\Infobox;

class InfoboxRegistry {

    /**
     * Registered infobox type.
     *
     * @var array $boxes
     */
    protected $boxes = [];

    /**
     * Register new Infobox.
     *
     * @param  string  $key
     * @param  Infobox $box
     * @param  bool    $override
     * @return void
     */
    public function register($key, Infobox $box, $override = false) {
        if( $this->has($key) ) {
            $this->boxes[$key] = ($override) ? $box : $this->boxes[$key];
        }
        else
        {
            $this->boxes[$key] = $box;
        }
    }

    /**
     * Determine if the box with the given key exists.
     *
     * @param  string $key
     * @return bool
     */
    public function has($key) {
        return (bool) isset($this->boxes[$key]);
    }

    /**
     * Get the box with based on the given key.
     *
     * @param  string $key
     * @return Infobox|null
     */
    public function get($key) {
        if( $this->has($key) ) return $this->boxes[$key];
    }

    /**
     * Get all registered boxes.
     *
     * @return array
     */
    public function all() {
        return $this->boxes;
    }
}
