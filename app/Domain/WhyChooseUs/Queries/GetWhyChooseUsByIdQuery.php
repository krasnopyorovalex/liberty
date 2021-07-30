<?php

declare(strict_types=1);

namespace Domain\WhyChooseUs\Queries;

use App\Models\WhyChooseUs;

/**
 * Class GetWhyChooseUsByIdQuery
 * @package Domain\WhyChooseUs\Queries
 */
class GetWhyChooseUsByIdQuery
{
    /**
     * @var int
     */
    private int $id;

    /**
     * GetWhyChooseUsByIdQuery constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        return WhyChooseUs::findOrFail($this->id);
    }
}
