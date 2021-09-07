<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecallSent extends Mailable
{
    use Queueable, SerializesModels;

    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function build(): RecallSent
    {
        return $this->view('emails.recall', ['data' => $this->data])
            ->subject('Форма: Перезвоните мне');
    }
}
