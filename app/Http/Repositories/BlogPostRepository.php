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
            ->with([
                'category:id,title',
                'user:id,name'
            ])
            // или можно так 'category' => function ($query) {
                // $query->select(['id','title']);
            ->paginate(25);

        return $result;
    }

    public function getEdit(int $id)
    {
        return $this->startCondition()->find($id);
    }
}
