<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title"></div>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Основные данные</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Дополнительно</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="maindata" role="tabpanel">
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
                            <label for="slug">Идентификатор / Slug</label>
                            <input type="text"
                                   id="slug"
                                   name="slug"
                                   class="form-control" value="{{ $item->slug }}">
                        </div>

                        <div class="form-group">
                            <label for="parent_id">Родитель</label>
                            <select name="parent_id"
                                    id="parent_id"
                                    class="form-control"
                                    required>
                                @foreach($categoryList as $categoryOption)
                                    <option value="{{ $categoryOption->id }}"
                                        @if($categoryOption->id === $item->parent_id) selected @endif>
                                        {{ $categoryOption->id }}. {{ $categoryOption->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">Описание</label>
                            <textarea name="description"
                                      id="description"
                                      class="form-control"
                                      cols="30"
                                      rows="10"> {{ old('description', $item->description) }}
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
