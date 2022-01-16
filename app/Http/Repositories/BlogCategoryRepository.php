<?php


namespace App\Http\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Support\Collection;

class BlogCategoryRepository extends CoreRepository
{
    protected function getModelClass(): string
    {
        return Model::class;
    }

    /*
     * ПОлучить модель для редакторивания в админке
     */

    public function getEdit(int $id): Model
    {
        return $this->startCondition()->find($id);
    }

    /*
     * Получить список(коллекцию) категорий дял вывода в выпадающем спсике
     */
    public function getForSelect(): Collection|\stdClass
    {
//        return $this->startCondition()->all();
        $columns = ['id','title'];

        $result = $this->startCondition()
            ->select($columns)
            ->toBase()
            ->get();

        return $result;
    }

    /*
     * Получить все категории для вывода пагинатором
     */
    public function getAllWithPaginate(int|null $perPage)
    {
        $colums = ['id','title','parent_id'];

        $result = $this->startCondition()
            ->select($colums)
            ->paginate($perPage);

        return $result;
    }
}
