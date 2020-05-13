<?php

namespace Modules\Softether\Services;

use App\Server;
use App\Contracts\Server\ServerHook;
use App\Contracts\Server\RequireServerInfo;
use App\Contracts\Server\ServerSoftware;
use App\Services\Server\BaseSoftware;

final class SoftetherSoftware extends BaseSoftware
    implements ServerSoftware, RequireServerInfo, ServerHook
{

    protected $name = "SoftEther VPN";

    protected $description = <<<EOF
    Deploy multi-protocol VPN server using SOFTETHER!
    <br />
    <br />
    Including :
    <ul>
        <li>OpenVPN</li>
        <li>L2TP</li>
        <li>L2TP/IPSec</li>
        <li>MS-SSTP</li>
        <li>PPP Over HTTPS</li>
    </ul>
EOF;

    protected $image = 'https://dl1.cbsistatic.com/i/2016/07/06/e1e86e8c-5f81-480c-a55d-b91ed17c2fdc/03c39ec529a0b19e1c6700e2a2cd02a7/imgingest-1829430798785509634.png';

    protected $server;

    protected $updateUrl;

    protected $hookUrl;

    protected $script = [
        "\n",
        "# SOFTETHER",
        "apt-get update",
        "apt-get install git -y",
        "git clone https://github.com/sshpanel/softether-public-installer",
        "cd softether-public-installer",
        "chmod +x init && bash init"
    ];

    public function getReservedPorts(): array
    {
        return [
            500, 4500, 1701, // L2TP
            1194, // OpenVPN
            5555, // Softether management
            992
        ];
    }

    public function generateInstallationScript() {
        return collect($this->script)->implode("\n");
    }


    public function setServer(Server $server) {
        $this->server = $server;

        return $this;
    }

    public function getServer() : Server {
        return $this->server;
    }

    public function setUpdateUrl($updateUrl){
        $this->updateUrl = $updateUrl;

        return $this;
    }

    public function getUpdateUrl() {
        return $this->updateUrl;
    }

    public function setHookUrl($hookUrl) {
        $this->hookUrl = $hookUrl;

        return $this;
    }

    public function getHookUrl() {
        return $this->hookUrl;
    }
}
