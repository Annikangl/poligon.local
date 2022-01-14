<?php


namespace App\Http\Repositories;


use App\Models\BlogCategory as Model;

class BlogCategoryRepository extends CoreRepository
{
    protected function getModelClass(): string
    {
        return Model::class;
    }
}
