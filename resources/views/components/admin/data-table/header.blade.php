@if(!empty($columns))
    <thead>
    <tr>
        <th>
            <div class="animated-checkbox">
                <label class="m-0">
                    <input type="checkbox" id="record__select-all">
                    <span class="label-text"></span>
                </label>
            </div>
        </th>
        @foreach($columns as $column)
            <th>{{ trans($column) }}</th>
        @endforeach
        <th>{{ trans('site.created_at') }}</th>
        <th>{{ trans('site.action') }}</th>
    </tr>
    </thead>
@endif