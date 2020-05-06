<?php

namespace App\Services;

use App\Contracts\Concerns\Link;

class Alert {

    protected const TYPE_PRIMARY = 'primary';

    protected const TYPE_SUCCESS = 'success';

    protected const TYPE_WARNING = 'warning';

    protected const TYPE_DANGER  = 'danger';

    protected $allowedTypes = [
        self::TYPE_PRIMARY,
        self::TYPE_SUCCESS,
        self::TYPE_WARNING,
        self::TYPE_DANGER
    ];

    protected $supportedConfig = [
        'links'
    ];

    /**
     * Registered Alerts.
     *
     * @var  array $alerts
     */
    protected $alerts = [];

    public function primary($message, array $config = []) {
        $this->addAlert(self::TYPE_PRIMARY, $message, $config);
    }

    public function success($message, array $config = []) {
        $this->addAlert(self::TYPE_SUCCESS, $message, $config);
    }

    public function warning($message, array $config = []) {
        $this->addAlert(self::TYPE_WARNING, $message, $config);
    }

    public function danger($message, array $config = [])  {
        $this->addAlert(self::TYPE_DANGER, $message, $config);
    }

    public function addAlert($type, &$message, array $config = []) {

        if( ! in_array($type, $this->allowedTypes) )
            throw \InvalidArgumentException('Unsuported alert type.');


        foreach($config as $key => $value) {
            if( ! $this->isConfigSupported($key) )
                throw new \InvalidArgumentException("Unsuported alert config: " . $key);


            switch($key) {
                case 'links':

                    $this->configureLinks($message, $value);

                    break;

                default:
            }
        }

        // Message formatted! Render the view.
        $view = view(sprintf("alerts.%s", $type), compact('message'));

        $this->alerts[] = $view;
    }

    public function getAlerts() {
        return $this->alerts;
    }

    /**
     * The Links parser.
     *
     * @return void
     */
    protected function configureLinks(&$message, $links) {

        foreach($links as $alias => $link) {

            if( ! $link instanceof Link ) return;

            $message = str_replace(
                $alias,
                sprintf(
                    "<a href='%s' class='alert-link'>%s</a>",
                    $link->getHref(),
                    $link->getName()
                ),
                $message
            );

        }
    }

    protected function isConfigSupported($key) {
        return (bool) in_array($key, $this->supportedConfig);
    }
}
