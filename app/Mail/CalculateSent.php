<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CalculateSent extends Mailable
{
    use Queueable, SerializesModels;

    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function build(): CalculateSent
    {
        return $this->view('emails.calculate', ['data' => $this->data])
            ->subject('Форма: Расчёт проекта')
            ->attach($this->data['file']->getRealPath(), [
                'as' => $this->data['file']->getClientOriginalName(),
                'mime' => $this->data['file']->getClientMimeType(),
            ]);
    }
}
