<?php

declare(strict_types=1);

namespace Domain\Image\Commands;

use App\Models\Image;

/**
 * Class CreateImageCommand
 * @package Domain\Image\Commands
 */
class CreateImageCommand
{

    /**
     * @var array
     */
    private array $data;

    /**
     * CreateImageCommand constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $image = new Image();
        $image->fill($this->data);

        return $image->save();
    }

}
