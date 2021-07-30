<?php

declare(strict_types=1);

namespace Domain\WhyChooseUs\Commands;

use Domain\WhyChooseUs\Queries\GetWhyChooseUsByIdQuery;
use App\Http\Requests\Request;
use App\Models\WhyChooseUs;
use Closure;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Storage;

/**
 * Class UpdateWhyChooseUsCommand
 * @package Domain\WhyChooseUs\Commands
 */
class UpdateWhyChooseUsCommand
{
    use DispatchesJobs;

    private Request $request;
    private int $id;
    private Closure $deleter;

    /**
     * UpdateWhyChooseUsCommand constructor.
     * @param int $id
     * @param Request $request
     */
    public function __construct(int $id, Request $request)
    {
        $this->id = $id;
        $this->request = $request;

        $this->deleter = static fn (string $path) => Storage::delete($path);
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $whyChooseUs = $this->dispatch(new GetWhyChooseUsByIdQuery($this->id));

        if ($this->request->has('image')) {
            if ($whyChooseUs->image) {
                ($this->deleter)(str_replace('/storage/', '/public/', $whyChooseUs->image));
            }

            $path = $this->request->file('image')->store(WhyChooseUs::STORE_PATH);
            $whyChooseUs->image = Storage::url($path);
        }

        if ($this->request->has('image_mob')) {
            if ($whyChooseUs->image_mob) {
                ($this->deleter)(str_replace('/storage/', '/public/', $whyChooseUs->image_mob));
            }

            $path = $this->request->file('image_mob')->store(WhyChooseUs::STORE_PATH);
            $whyChooseUs->image_mob = Storage::url($path);
        }

        return $whyChooseUs->update($this->request->validated());
    }
}
