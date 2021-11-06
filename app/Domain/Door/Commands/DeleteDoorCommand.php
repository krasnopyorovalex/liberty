<?php

declare(strict_types=1);

namespace Domain\Door\Commands;

use App\Services\UploadImagesService;
use Domain\Door\Queries\GetDoorByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Storage;

/**
 * Class DeleteDoorCommand
 * @package Domain\Door\Commands
 */
class DeleteDoorCommand
{
    use DispatchesJobs;

    /**
     * @var int
     */
    private int $id;

    /**
     * DeleteDoorCommand constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle(): bool
    {
        $door = $this->dispatch(new GetDoorByIdQuery($this->id));

        if ($door->image) {
            Storage::delete(str_replace('/storage/', '/public/', $door->image));
            Storage::delete(str_replace('/storage/', '/public/', filename_replacer($door->image, UploadImagesService::DESKTOP_POSTFIX)));
            Storage::delete(str_replace('/storage/', '/public/', filename_replacer($door->image, UploadImagesService::MOBILE_POSTFIX)));
        }

        if ($door->file) {
            Storage::delete(str_replace('/storage/', '/public/', $door->file));
        }

        return $door->delete();
    }
}
