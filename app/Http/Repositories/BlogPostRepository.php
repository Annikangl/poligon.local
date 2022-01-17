<?php


namespace App\Http\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Pagination\Paginator;

class BlogPostRepository extends CoreRepository
{

    protected function getModelClass(): string
    {
        return Model::class;
    }

    public function getAllWithPaginate()
    {
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id'
        ];

        $result = $this->startCondition()
            ->select($columns)
            ->orderBy('id','DESC')
            ->paginate(25);

        return $result;
    }
}
