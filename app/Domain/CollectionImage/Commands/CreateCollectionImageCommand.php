<?php

declare(strict_types=1);

namespace Domain\CollectionImage\Commands;

use App\Models\CollectionImage;
use App\Services\UploadImagesService;

/**
 * Class CreateCollectionImageCommand
 * @package Domain\CollectionImage\Commands
 */
class CreateCollectionImageCommand
{

    private UploadImagesService $uploadImage;

    /**
     * CreateCollectionImageCommand constructor.
     * @param UploadImagesService $uploadImage
     */
    public function __construct(UploadImagesService $uploadImage)
    {
        $this->uploadImage = $uploadImage;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $collectionImage = new CollectionImage();
        $collectionImage->basename = $this->uploadImage->getImageHashName();
        $collectionImage->ext = $this->uploadImage->getExt();
        $collectionImage->collection_id = $this->uploadImage->getEntityId();
        $collectionImage->is_mobile = $this->uploadImage->getIsMobile();

        return $collectionImage->save();
    }
}
