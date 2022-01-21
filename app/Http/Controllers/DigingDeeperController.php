<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;


class DigingDeeperController extends Controller
{
    public function collections()
    {
        $result = [];

        $eloquentCollection = BlogPost::withoutTrashed()->get();


        $collection = collect($eloquentCollection->toArray());

        $result['first'] = $collection->first();
        $result['last'] = $collection->last();

        $result['where']['data'] = $collection
            ->where('category_id',10)
            ->values()
            ->keyBy('id');

        $result['where']['count'] = $result['where']['data']->count();
        $result['where']['isEmpty'] = $result['where']['data']->isEmpty();
        $result['where']['isNotEmpty'] = $result['where']['data']->isNotEmpty();

        $result['where_first'] = $collection
            ->firstWhere('created_at', '>','2021-11-21 22:32:04');

        // Базовая переменная не изменится. Просто вернется измененная версия.
        $result['map']['all'] = $collection
            ->map(function (array $item) {
                $newItem = new \stdClass();
                $newItem->item_id = $item['id'];
                $newItem->item_name = $item['title'];
                $newItem->exists = is_null($item['deleted_at']);

                return $newItem;
            });

//        $collection->transform(function (array $item) {
//            $newItem = new \stdClass();
//            $newItem->item_id = $item['id'];
//            $newItem->item_name = $item['title'];
//            $newItem->exists = is_null($item['deleted_at']);
//
//            return $newItem;
//        });


        dd(compact('collection'));
    }
}
