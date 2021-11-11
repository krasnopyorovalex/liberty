<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\Favorite;
use App\Domain\Favorite\Dto\FavoriteCollectionDto;
use App\Models\Door;
use App\Models\Furniture;
use Domain\Favorite\Requests\FavoriteRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class FavoriteController extends Controller
{
    private Favorite $favorite;

    public function __construct(Favorite $favorite)
    {
        $this->favorite = $favorite;
    }

    /**
     * @return Application|Factory|View
     * @throws \ReflectionException
     */
    public function index()
    {
        $favoriteCollectionDto = new FavoriteCollectionDto();

        foreach ($this->favorite->list() as $favorite) {
            $instance = (new \ReflectionClass($favorite->entity_class))->newInstance();

            switch ($favorite->entity_class) {
                case (Door::class):
                    $favoriteCollectionDto->doors[] = $instance::where('id', $favorite->entity_id)->first();
                    break;
                case (Furniture::class):
                    $favoriteCollectionDto->furniture[] = $instance::where('id', $favorite->entity_id)->first();
                    break;
                default:
                    $favoriteCollectionDto->portfolio[] = $instance::where('id', $favorite->entity_id)->first();
            }
        }

        return view('favorite.index', ['favoriteCollectionDto' => $favoriteCollectionDto]);
    }

    public function add(int $id, FavoriteRequest $request): JsonResponse
    {
        $this->favorite->add($id, (string)$request->get('entity'));

        return response()->json([
            'message' => (string)view('layouts.partials.notify', [
                'message' => 'Предмет добавлен в Избранное',
                'cssClass' => 'info-msg',
                'icon' => 'mood-happy'
            ])
        ]);
    }

    public function remove(int $id, FavoriteRequest $request): JsonResponse
    {
        $this->favorite->remove($id, (string)$request->get('entity'));

        return response()->json([
            'message' => (string)view('layouts.partials.notify', [
                'message' => 'Предмет удалён из Избранного',
                'cssClass' => 'info-msg',
                'icon' => 'mood-happy'
            ])
        ]);
    }
}
