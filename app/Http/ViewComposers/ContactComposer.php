<?php

declare(strict_types=1);

namespace App\Http\ViewComposers;

use Domain\Contact\Queries\GetAllContactsQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\DispatchesJobs;

class ContactComposer
{
    use DispatchesJobs;

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        /** @var Collection $contacts */
        $contacts = $this->dispatch(new GetAllContactsQuery());

        $view->with('contacts', $contacts);
    }
}
