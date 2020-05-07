<?php

namespace App\Services;

use Closure;
use App\Registries\InfoboxRegistry;

class Infobox {

    /**
     * The registered infoboxes.
     *
     * @var  array $boxes
     */
    protected $boxes = [];

    /**
     * The InfoboxRegistry instance.
     *
     * @var  InfoboxRegistry $registry
     */
    protected $registry;

    /**
     * Build the facade instance.
     *
     * @param  InfoboxRegistry $registry
     * @return void
     */
    public function __construct(InfoboxRegistry $registry)
    {
        $this->registry = $registry;
    }

    public function addBox($key, Closure $callback) {


        if( ! $this->registry->has($key) )
            throw \InvalidArgumentException(sprintf("Invalid box instance with key %s.", $key));

        $box = $this->registry->get($key);

        $callback($box);

        $this->boxes[] = $box;

        return $this;
    }

    /**
     * Get all boxes.
     *
     * @return array
     */
    public function getBoxes() {
        return $this->boxes;
    }
}
