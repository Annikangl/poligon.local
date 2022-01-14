<?php


namespace App\Http\Repositories;

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

    protected $model;

    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    abstract protected function getModelClass();

    protected function startCondition() : Application|null
    {
        return clone $this->model;
    }

}
