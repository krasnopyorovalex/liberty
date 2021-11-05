<?php

declare(strict_types=1);

namespace App\Models;

use App\Services\UploadImagesService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $furniture_id
 * @property string $basename
 * @property string $ext
 * @property string $is_mobile
 */
class FurnitureImage extends Model
{
    use HasFactory;

    public const WIDTH = 639;
    public const HEIGHT = 639;

    public const WIDTH_MOBILE = 340;
    public const HEIGHT_MOBILE = 450;

    public $timestamps = [];

    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function furniture(): BelongsTo
    {
        return $this->belongsTo(Furniture::class);
    }

    /**
     * @return string
     */
    public function getThumb(): string
    {
        return asset('storage/furniture/' . $this->furniture_id . '/' . $this->basename . '_thumb.' . $this->ext);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return asset('storage/furniture/' . $this->furniture_id . '/' . $this->basename . '.' . $this->ext);
    }

    public function getMobileImage(): string
    {
        $image = sprintf('storage/furniture/%d/%s.%s', $this->furniture_id, $this->basename, $this->ext);

        return asset(filename_replacer($image, UploadImagesService::MOBILE_POSTFIX));
    }

    public function getDesktopImage(): string
    {
        $image = sprintf('storage/furniture/%d/%s.%s', $this->furniture_id, $this->basename, $this->ext);

        return asset(filename_replacer($image, UploadImagesService::DESKTOP_POSTFIX));
    }
}
