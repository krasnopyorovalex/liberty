<?php

declare(strict_types=1);

namespace Domain\Redirect\Queries;

use App\Models\Redirect;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GetRedirectByIdQuery
 * @package Domain\Redirect\Queries
 */
class GetRedirectByUriQuery
{
    /**
     * @var string
     */
    private string $uri;

    /**
     * GetRedirectByUriQuery constructor.
     * @param string $uri
     */
    public function __construct(string $uri)
    {
        $this->uri = $uri;
    }

    /**
     * @return Redirect|Builder|Model|object|null
     */
    public function handle()
    {
        return Redirect::where('url_old', $this->uri)->first();
    }
}
