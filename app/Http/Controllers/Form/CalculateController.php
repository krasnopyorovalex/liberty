<?php

declare(strict_types=1);

namespace App\Http\Controllers\Form;

use App\Http\Controllers\Controller;
use App\Http\Requests\Forms\CalculateRequest;
use App\Mail\CalculateSent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\JsonResponse;

class CalculateController extends Controller
{
    public function __invoke(CalculateRequest $request): JsonResponse
    {
        try {
            Mail::to([env('MAIL_TO_ADDRESS')])
                ->send(new CalculateSent($request->validated()));
        } catch (\Exception $exception) {
            return response()->json([
                'message' => (string)view('layouts.partials.notify', ['message' => $exception->getMessage()])
            ], 400);
        }

        return response()->json([
            'message' => (string)view('layouts.partials.notify', [
                'message' => 'Форма отправлена успешно! Наш менеджер свяжется с Вами в ближайшее время.',
                'icon' => 'mood-happy'
            ])
        ]);
    }
}
