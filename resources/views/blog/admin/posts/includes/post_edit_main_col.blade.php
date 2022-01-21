<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                @if($item->is_published)
                    Опубликовано
                @else
                    Черновик
                @endif
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active"
                           id="main-tab"
                           data-bs-toggle="tab"
                           data-bs-target="#main"
                           role="tab"
                           aria-controls="main"
                           aria-selected="true">
                            Основные данные
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link"
                           id="adddata-tab"
                           data-bs-toggle="tab"
                           data-bs-target="#adddata"
                           role="tab"
                           aria-controls="adddata"
                           aria-selected="false">
                            Допольнительно
                        </a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="main" role="tabpanel" aria-labelledby="main-tab">
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input type="text"
                                   id="title"
                                   name="title"
                                   class="form-control"
                                   minlength="3"
                                   value="{{ $item->title }}"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="content_raw">Описание</label>
                            <textarea name="content_raw"
                                      id="content_raw"
                                      class="form-control"
                                      cols="30"
                                      rows="10"> {{ old('content_html', $item->content_html) }}
                            </textarea>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="adddata" role="tabpanel" aria-labelledby="adddata-tab">
                        <div class="form-group">
                            <label for="slug">Идентификатор / Slug</label>
                            <input type="text"
                                   id="slug"
                                   name="slug"
                                   class="form-control" value="{{ $item->slug }}">
                        </div>

                        <div class="form-group">
                            <label for="parent_id">Родитель</label>
                            <select name="category_id"
                                    id="category_id"
                                    class="form-control"
                                    required>
                                @foreach($categoryList as $categoryOption)
                                    <option value="{{ $categoryOption->id }}"
                                            @if($categoryOption->id === $item->category_id) selected @endif>
                                        {{ $categoryOption->id }}. {{ $categoryOption->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="excerpt">Выдержка</label>
                            <textarea dirname="excerpt"
                                      id="excerpt"
                                      class="form-control"
                                      rows="3"> {{ $item->excerpt }}
                            </textarea>
                        </div>

                        <div class="form-check mt-4">
                            <input name="is_published"
                                   type="hidden"
                                   value="0"
                            >
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="is_published"
                                   value="1"
                                   id="is_published"
                                   @if($item->is_published)
                                   checked
                                @endif
                            >
                            <label class="form-check-label" for="is_published">
                                Опубликовано
                            </label>
                        </div>


                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

