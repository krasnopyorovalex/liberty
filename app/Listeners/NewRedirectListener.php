<?php

declare(strict_types=1);

namespace App\Listeners;

use Domain\MenuItem\Commands\UpdateMenuItemsLinkCommand;
use Domain\MenuItem\Queries\GetMenuItemsByLinkQuery;
use App\Events\RedirectDetected;
use App\Models\Redirect;
use Illuminate\Foundation\Bus\DispatchesJobs;

class NewRedirectListener
{
    use DispatchesJobs;

    /**
     * Handle the event.
     *
     * @param  RedirectDetected  $event
     * @return void
     */
    public function handle(RedirectDetected $event): void
    {
        $this->checkIfExistsInMenu($event);

        $redirect = new Redirect;
        $redirect->url_old = $event->urlOld;
        $redirect->url_new = $event->urlNew;

        $redirect->save();
    }

    /**
     * @param RedirectDetected $event
     */
    private function checkIfExistsInMenu(RedirectDetected $event): void
    {
        $menuItemsExists = $this->dispatch(new GetMenuItemsByLinkQuery($event->urlOld));

        $this->dispatch(new UpdateMenuItemsLinkCommand($menuItemsExists, $event->urlNew));
    }
}
