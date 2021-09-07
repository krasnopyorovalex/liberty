<?php

declare(strict_types=1);

namespace App\Http\Controllers\Form;

use App\Domain\Guestbook\Commands\AddRecordToGuestbookCommand;
use App\Http\Controllers\Controller;
use App\Http\Requests\Forms\GuestbookRequest;
use App\Mail\GuestbookSent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\JsonResponse;

class GuestbookController extends Controller
{
    public function __invoke(GuestbookRequest $request): JsonResponse
    {
        try {
            $this->dispatch(new AddRecordToGuestbookCommand($request));

            Mail::to([env('MAIL_TO_ADDRESS')])
                ->send(new GuestbookSent($request->validated()));
        } catch (\Exception $exception) {
            return response()->json([
                'message' => (string)view('layouts.partials.notify', ['message' => $exception->getMessage()])
            ], 400);
        }

        return response()->json([
            'message' => (string)view('layouts.partials.notify', [
                'message' => 'Спасибо большое! Ваш отзыв добавлен!',
                'icon' => 'mood-happy'
            ])
        ]);
    }
}
