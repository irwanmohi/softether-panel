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

    public function addBox($key, Closure $callback, $show = true, $group = 'main') {

        if( ! $this->registry->has($key) )
            throw \InvalidArgumentException(sprintf("Invalid box instance with key %s.", $key));

        $box = $this->registry->get($key);

        $box = app(get_class($box));

        $callback($box);

        if ( is_callable($show) && true === $show() ) {
            $this->boxes[$group][] = $box;
        }

        if( is_bool($show) && true == $show ) {
            $this->boxes[$group][] = $box;
        }

        return $this;
    }

    /**
     * Get all boxes.
     *
     * @return array
     */
    public function getBoxes($group = 'main') {

        return (isset($this->boxes[$group]))
            ? $this->boxes[$group]
            : [];
    }

    public function resetGroup($group = null) {
        if( ! is_null($group) && isset($this->boxes[$group]) ) {
            $this->boxes[$group] = [];
        }
    }
}
