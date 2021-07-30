<?php

declare(strict_types=1);

namespace Domain\WhyChooseUs\Commands;

use App\Http\Requests\Request;
use App\Models\WhyChooseUs;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Storage;

/**
 * Class CreateWhyChooseUsCommand
 * @package Domain\WhyChooseUs\Commands
 */
class CreateWhyChooseUsCommand
{
    use DispatchesJobs;

    private Request $request;

    /**
     * CreateWhyChooseUsCommand constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $whyChooseUs = new WhyChooseUs();
        $whyChooseUs->fill($this->request->validated());

        if ($this->request->has('image')) {
            $path = $this->request->file('image')->store(WhyChooseUs::STORE_PATH);
            $whyChooseUs->image = Storage::url($path);
        }

        if ($this->request->has('image_mob')) {
            $path = $this->request->file('image_mob')->store(WhyChooseUs::STORE_PATH);
            $whyChooseUs->image_mob = Storage::url($path);
        }

        return $whyChooseUs->save();
    }
}
