<?php

declare(strict_types=1);

namespace App\Domain\Guestbook\Commands;

use App\Http\Requests\Forms\GuestbookRequest;
use App\Models\Guestbook;

class AddRecordToGuestbookCommand
{
    private GuestbookRequest $request;

    public function __construct(GuestbookRequest $request)
    {
        $this->request = $request;
    }

    public function handle(): void
    {
        (new Guestbook())
            ->fill($this->request->validated())
            ->save();
    }
}
