<?php

declare(strict_types=1);

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class RedirectDetected
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var string
     */
    public string $urlOld;

    /**
     * @var string
     */
    public string $urlNew;

    /**
     * @var string
     */
    public string $routeName;

    /**
     * RedirectDetected constructor.
     * @param string $urlOld
     * @param string $urlNew
     * @param string $routeName
     */
    public function __construct(string $urlOld, string $urlNew, string $routeName = 'page.show')
    {
        $this->urlOld = route($routeName, ['alias' => $urlOld], false);
        $this->urlNew = route($routeName, ['alias' => $urlNew], false);
    }
}
