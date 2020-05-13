<?php

namespace App\Services;

use BadMethodCallException;
use ScriptFUSION\Byte\Base;
use ScriptFUSION\Byte\ByteFormatter;

class Byte {

    protected $formatter;

    protected $base;

    protected $precision = 2;

    public function __construct(ByteFormatter $formatter)
    {
        $this->base = Base::DECIMAL;

        $this->formatter = $formatter->setBase($this->base)
                                     ->setPrecision($this->precision);
    }

    public function base($base) {
        $this->base = $base;

        $this->formatter->setBase($this->base);

        return $this;
    }

    public function precision($precision) {
        $tihs->precision = $precision;

        $this->formatter->setPrecision($this->precision);

        return $this;
    }

    public function __call($method, $args) {
        if( method_exists($this->formatter, $method) )
            return \call_user_func_array([$this->formatter, $method], $args);

        throw new BadMethodCallException(sprintf("Method %s:%s() does not exists.", $method, get_class($this)));
    }

}
