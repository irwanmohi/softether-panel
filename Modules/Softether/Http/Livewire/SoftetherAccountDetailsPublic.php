<?php

namespace Modules\Softether\Http\Livewire;

use App\Facades\Byte;
use App\Contracts\Concerns\Colors;
use Livewire\Component;
use App\Contracts\Infobox;
use App\Facades\Infobox as Box;
use Carbon\Carbon;
use Modules\Softether\Entities\SoftetherAccount;
use Modules\Softether\Jobs\SynchronizeSoftetherAccountDetails;

class SoftetherAccountDetailsPublic extends Component
{

    public $pollStats = true;

    public $tab = 'services';

    public $readyToLoad = false;

    public $firstTime = true;

    public $softetherAccount;

    public function mount(SoftetherAccount $softetherAccount) {
        $this->softetherAccount = $softetherAccount;
    }

    public function render()
    {
        return view('softether::livewire.softether-account-details-public');
    }

    public function refreshDetails() {


        $this->softetherAccount = $this->softetherAccount->fresh();

        $this->loadData();
    }

    protected function generateAccountBoxes() {

        $group = sprintf('accounts.%s.%s',
            $this->softetherAccount->softether_server_id,
            $this->softetherAccount->id
        );

        //Box::addBox('dual', function(Infobox $box) {
                //$box->setTitle('UNICAST PACKETS OUT');
                //$box->setValue($this->softetherAccount->outgoing_unicast_packets);
                //$box->setColor(Colors::INDIGO);
                //$box->setIcon('trending_up');
            //}, true, $group);


        Box::addBox('dual', function(Infobox $box) {
                $box->setTitle('UNICAST TX');
                $box->setValue(Byte::format($this->softetherAccount->outgoing_unicast_size));
                $box->setColor(Colors::TEAL);
                $box->setIcon('call_made');
            }, true, $group);

        //Box::addBox('dual', function(Infobox $box) {
                //$box->setTitle('UNICAST PACKETS IN');
                //$box->setValue($this->softetherAccount->incoming_unicast_packets);
                //$box->setColor(Colors::LIGHT_BLUE);
                //$box->setIcon('trending_down');
            //}, true, $group);

        Box::addBox('dual', function(Infobox $box) {
                $box->setTitle('UNICAST RX');
                $box->setValue(Byte::format($this->softetherAccount->incoming_unicast_size));
                $box->setColor(Colors::BLUE_GREY);
                $box->setIcon('call_received');
            }, true, $group);


        //Box::addBox('dual', function(Infobox $box) {
                //$box->setTitle('BROADCAST PCKTS OUT');
                //$box->setValue($this->softetherAccount->outgoing_broadcast_packets);
                //$box->setColor(Colors::PURPLE);
                //$box->setIcon('call_split');
            //}, true, $group);


        Box::addBox('dual', function(Infobox $box) {
                $box->setTitle('BROADCAST PACKETS');
                $box->setValue($this->softetherAccount->incoming_broadcast_packets);
                $box->setColor(Colors::PINK);
                $box->setIcon('arrow_downward');
            }, true, $group);

        Box::addBox('dual', function(Infobox $box) {
                $box->setTitle('BROADCAST TX');
                $box->setValue(Byte::format($this->softetherAccount->outgoing_broadcast_size));
                $box->setColor(Colors::DEEP_PURPLE);
                $box->setIcon('multiline_chart');
            }, true, $group);


        Box::addBox('dual', function(Infobox $box) {
                $box->setTitle('BROADCAST RX');
                $box->setValue(Byte::format($this->softetherAccount->incoming_broadcast_size));
                $box->setColor(Colors::DEEP_ORANGE);
                $box->setIcon('file_download');
            }, true, $group);

        Box::addBox('dual', function(Infobox $box) {
                $box->setTitle('TOTAL LOGINS');
                $box->setValue($this->softetherAccount->total_logins);
                $box->setColor(Colors::BROWN);
                $box->setIcon('assignment_turned_in');
            }, true, $group);


        Box::addBox('dual', function(Infobox $box) {
                $box->setTitle('ACCOUNT STATUS');
                $box->setValue($this->softetherAccount->status);

                if($this->softetherAccount->status == 'ACTIVE') {
                    $box->setColor(Colors::GREEN);
                    $box->setIcon('check');
                }

                if($this->softetherAccount->status == 'INACTIVE') {
                    $box->setColor(Colors::RED);
                    $box->setIcon('cancel');
                }

                if($this->softetherAccount->status == 'EXPIRED') {
                    $box->setColor(Colors::ORANGE);
                    $box->setIcon('timer_off');
                }


                if($this->softetherAccount->status == 'FAILED') {
                    $box->setColor(Colors::RED);
                    $box->setIcon('cancel');
                }

                if($this->softetherAccount->status == 'CREATING') {
                    $box->setColor(Colors::DEEP_ORANGE);
                    $box->setIcon('gesture');
                }

            }, true, $group);

            if( $this->softetherAccount->status == 'ACTIVE' ) {

                Box::addBox('dual', function(Infobox $box) {
                    $box->setTitle('ACCOUNT EXPIRED ON');
                    $box->setValue(now()->diffInDays(Carbon::parse($this->softetherAccount->expired_date)) . ' DAYS');
                    $box->setColor(Colors::GREY);
                    $box->setIcon('timer');
                }, true, $group);
            }

    }

    public function loadData() {

        Box::resetGroup(
            sprintf('accounts.%s.%s',
                $this->softetherAccount->softether_server_id,
                $this->softetherAccount->id
            )
        );

        $this->generateAccountBoxes();

        if( ! $this->firstTime ) {
            SynchronizeSoftetherAccountDetails::dispatch($this->softetherAccount);
        }

        $this->readyToLoad = true;
        $this->firstTime   = false;
    }

}
