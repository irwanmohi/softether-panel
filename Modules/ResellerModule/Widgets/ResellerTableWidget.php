<?php

namespace Modules\ResellerModule\Widgets;

use Arrilot\Widgets\AbstractWidget;

class ResellerTableWidget extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //

        return view('resellermodule::widgets.reseller_table_widget', [
            'config' => $this->config,
        ]);
    }
}
