<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Blog\BaseController as GuestController;

/*
 * Базовый   контроллер для всех контроллеров управления
 * блогом в панели администрирования
 *
 * Должен быть родителем всех контроллеров управления блогом
 */
abstract class BaseController extends GuestController
{

    public function __construct()
    {
    }
}
