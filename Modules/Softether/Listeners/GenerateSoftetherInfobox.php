<?php

namespace Modules\Softether\Listeners;

use Infobox as Box;
use App\Contracts\Infobox;
use App\Contracts\Concerns\Colors;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Softether\Entities\SoftetherAccount;

class GenerateSoftetherInfobox
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {

        $softetherAccounts = SoftetherAccount::whereIn('status', ['ACTIVE', 'EXPIRED']);

        if( ! user()->isAdmin() ) {
            $softetherAccounts->where('user_id', user()->id);
        }

        $softetherAccounts = $softetherAccounts->get();

        Box::addBox('full-color',
            function(Infobox $box) use($softetherAccounts) {
                $box->setTitle('Total VPN Account');
                $box->setValue($softetherAccounts->count());
                $box->setColor(Colors::DEEP_ORANGE);
                $box->setIcon('vpn_key');
            }
        );

        Box::addBox('full-color',
            function(Infobox $box) use($softetherAccounts) {
                $box->setTitle('Active VPN Account');
                $box->setValue($softetherAccounts->where('status', 'ACTIVE')->count());
                $box->setColor(Colors::GREEN);
                $box->setIcon('vpn_key');
            }
        );

        Box::addBox('full-color',
            function(Infobox $box) use($softetherAccounts) {
                $box->setTitle('Expired VPN Account');
                $box->setValue($softetherAccounts->where('status', 'EXPIRED')->count());
                $box->setColor(Colors::ORANGE);
                $box->setIcon('vpn_key');
            }
        );

        Box::addBox('full-color',
            function(Infobox $box) use($softetherAccounts) {
                $box->setTitle('Locked VPN Account');
                $box->setValue($softetherAccounts->where('is_locked', true)->count());
                $box->setColor(Colors::LIGHT_BLUE);
                $box->setIcon('lock');
            }
        );
    }
}
