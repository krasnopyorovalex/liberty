<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManager;

/**
 * Class UploadImagesService
 * @package App\Services
 */
final class UploadImagesService
{
    private int $widthThumb = 192;
    private int $heightThumb = 192;

    /**
     * @var UploadedFile
     */
    private UploadedFile $image;

    /**
     * @var int
     */
    private int $entityId;

    /**
     * @var string
     */
    private string $entity;

    private bool $withThumb = false;

    /**
     * @param Request $request
     * @param string $entity
     * @param int $entityId
     * @return UploadImagesService
     */
    public function upload(Request $request, string $entity, int $entityId): self
    {
        $this->entityId = $entityId;
        $this->entity = $entity;
        $this->image = $request->file('upload');

        $this->image->store($this->getSavePath());

        if ($this->withThumb) {
            $this->createThumb();
        }

        return $this;
    }

    public function withThumb(): UploadImagesService
    {
        $this->withThumb = true;

        return $this;
    }

    /**
     * @param int $widthThumb
     * @return UploadImagesService
     */
    public function setWidthThumb(int $widthThumb): self
    {
        $this->widthThumb = $widthThumb;

        return $this;
    }

    /**
     * @return string
     */
    public function getImageHashName():string
    {
        $chunks = explode('.', $this->image->hashName());

        return strval(array_shift($chunks));
    }

    /**
     * @return string
     */
    public function getExt(): string
    {
        return $this->image->extension();
    }

    /**
     * @return int
     */
    public function getEntityId(): int
    {
        return $this->entityId;
    }

    /**
     * @return string
     */
    private function getSavePath(): string
    {
        return 'public/' . $this->entity . '/' . $this->entityId . '/';
    }

    private function createThumb(): void
    {
        (new ImageManager())
            ->make($this->image)
            ->fit($this->widthThumb, $this->heightThumb)
            ->save(public_path('storage/' . $this->entity . '/' . $this->entityId .'/' . $this->getImageHashName() . '_thumb.' . $this->getExt()));
    }

    /**
     * @param int $heightThumb
     * @return UploadImagesService
     */
    public function setHeightThumb(int $heightThumb): UploadImagesService
    {
        $this->heightThumb = $heightThumb;
        return $this;
    }
}
