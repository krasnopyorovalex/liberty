<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Domain\Contact\Commands\CreateContactCommand;
use Domain\Contact\Commands\DeleteContactCommand;
use Domain\Contact\Commands\UpdateContactCommand;
use Domain\Contact\Queries\GetAllContactsQuery;
use Domain\Contact\Queries\GetContactByIdQuery;
use Domain\Contact\Requests\CreateContactRequest;
use Domain\Contact\Requests\UpdateContactRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class ContactController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $contacts = $this->dispatch(new GetAllContactsQuery());

        return view('admin.contacts.index', [
            'contacts' => $contacts
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.contacts.create');
    }

    /**
     * @param CreateContactRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateContactRequest $request)
    {
        $this->dispatch(new CreateContactCommand($request));

        return redirect(route('admin.contacts.index'));
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $contact = $this->dispatch(new GetContactByIdQuery($id));

        return view('admin.contacts.edit', [
            'contact' => $contact
        ]);
    }

    /**
     * @param int $id
     * @param UpdateContactRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(int $id, UpdateContactRequest $request)
    {
        $this->dispatch(new UpdateContactCommand($id, $request));

        return redirect(route('admin.contacts.index'));
    }

    /**
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(int $id)
    {
        $this->dispatch(new DeleteContactCommand($id));

        return redirect(route('admin.contacts.index'));
    }
}
