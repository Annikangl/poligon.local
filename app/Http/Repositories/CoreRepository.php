<?php


namespace App\Http\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;

/**
 * Class CoreRepository
 * @package App\Http\Repositories
 *
 * РРепозиторий работы с сущностью.
 * Может выдавать набор данных.
 * Не может создавать/изменять сущности.
 */
abstract class CoreRepository
{

    protected Model $model;

    /*
     * Создает объект модели (имя класса потомка, который реализует абстрактный метод
     */
    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    abstract protected function getModelClass();

    protected function startCondition()
    {
        return clone $this->model;
    }

}
