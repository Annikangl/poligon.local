<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Repositories\BlogCategoryRepository;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{

    private BlogCategoryRepository $blogCategoryRepository;

    public function __construct()
    {
        parent::__construct();

        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    public function index()
    {
//        $paginator = BlogCategory::paginate(5);
        $paginator = $this->blogCategoryRepository->getAllWithPaginate(25);

        return view('blog.admin.categories.index', compact('paginator'));
    }


    public function create()
    {
        $item = BlogCategory::make();
        $categoryList = $this->blogCategoryRepository->getForSelect();


        return view('blog.admin.categories.edit',
            compact('item','categoryList'));
    }


    public function store(BlogCategoryCreateRequest $request)
    {
        $request_data = $request->input();

//        if (empty($request_data['slug'])) {
//            $request_data['slug'] = \Str::slug($request_data['title']);
//        }

        $item = BlogCategory::create($request_data);

        if ($item) {
            return redirect()->route('blog.admin.categories.edit', [$item->id])
                ->with(['success' => 'Сохранено успешно']);
        }

        return back()->withErrors(['msg' => 'Ошибка сохранения'])
            ->withInput();
    }


    public function edit($id, BlogCategoryRepository $categoryRepository)
    {
        $item = $this->blogCategoryRepository->getEdit($id);

        if (empty($item)) {
            abort(404);
        }
        $categoryList = $this->blogCategoryRepository->getForSelect();

        return view('blog.admin.categories.edit',
            compact('item','categoryList'));

    }



    public function update(Request $request, int $id)
    {
        $item = $this->blogCategoryRepository->getEdit($id);

        if ($item === null) {
            return back()->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }

        $request_data = $request->all();
        $result = $item->fill($request_data)->save();

        if ($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => 'Сохранено успешно']);
        }

        return back()
            ->withErrors(['msg' => 'Ошибка сохранения'])
            ->withInput();

    }

}
