<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\BlogCategoryRepository;
use App\Http\Repositories\BlogPostRepository;
use App\Http\Requests\BlogPostCreateRequest;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends BaseController
{
    private BlogPostRepository $blogPostRepository;
    private BlogCategoryRepository $blogCategoryRepository;

    public function __construct()
    {
        parent::__construct();

        $this->blogPostRepository = app(BlogPostRepository::class);
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }


    public function index()
    {
        $paginator = $this->blogPostRepository->getAllWithPaginate();

        return view('blog.admin.posts.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        // Создание пустого объекта вместо new)
        $item = BlogPost::make();

        $categoryList = $this->blogCategoryRepository->getForSelect();

        return view('blog.admin.posts.edit',
            compact('item','categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BlogPostCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BlogPostCreateRequest $request)
    {
        $request_data = $request->input();
        $item = BlogPost::create($request_data);

        if ($item) {
            return redirect()
                ->route('blog.admin.posts.edit', [$item->id])
                ->with(['success' => 'Успешно сохранено', 'msg' => 'Новая статья была успешно добавлено. Пожалуйста, убедитесь что она была опубликована']);
        }

        return back()
            ->withErrors(['msg' => 'Ошибка сохранения'])
            ->withInput();
    }

    public function edit(int $id)
    {
        $item = $this->blogPostRepository->getEdit($id);
        if (empty($item)) {
            abort(404);
        }

        $categoryList = $this->blogCategoryRepository->getForSelect();

        return view('blog.admin.posts.edit',
            compact('item','categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, int $id)
    {
        $item = $this->blogPostRepository->getEdit($id);
        if (empty($item)) {
            return back()
                ->withErrors(['msg' => 'Ошибка. Такая запись не найдена'])
                ->withInput();
        }

        $request_data = $request->all();
//        if (empty($request_data['slug'])) {
//            $request_data['slug'] = Str::slug($request_data['title']);
//        }
//        if (empty($item->published_at) && $request_data['is_published']) {
//            $request_data['published_at'] = Carbon::now();
//        }

        $result = $item->update($request_data);

        if ($result) {
            return redirect()
                ->route('blog.admin.posts.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        }

        return back()
            ->withErrors(['msg' => 'Ошибка сохранения'])
            ->withInput();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): \Illuminate\Http\RedirectResponse
    {
        $result = BlogPost::destroy($id);

        if ($result) {
            return redirect()
                ->route('blog.admin.posts.index')
                ->with(['success' => 'Запись успешно удалена']);
        }

        return back()
            ->withErrors(['msg' => 'Ошибка удаления']);
    }
}
