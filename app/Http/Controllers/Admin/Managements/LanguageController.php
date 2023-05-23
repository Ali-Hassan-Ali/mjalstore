<?php

namespace App\Http\Controllers\Admin\Managements;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\Admin\Managements\Language\LanguageRequest;
use App\Http\Request\Admin\Managements\Language\StatusRequest;
use App\Http\Request\Admin\Managements\Language\DeleteRequest;
use App\Enums\Admin\LanguageType;
use App\Services\DatatableServices;
use App\models\Language;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;

class LanguageController extends Controller
{
    public function index(): View
    {
        if(!permissionAdmin('read-languages')) {
            return abort(403);
        }

        $datatables = (new DatatableServices())->header(
            [
                'route' => route('admin.managements.languages.data'),
                'route_status' => route('admin.managements.languages.status'),
                'header'  => [
                    'site.name',
                    'site.dir',
                    'site.code',
                    'site.default',
                    'site.admin',
                    'site.status',
                ],
                'columns' => [
                    'name'   => 'name',
                    'dir'    => 'dir',
                    'code'   => 'code',
                    'default'=> 'default',
                    'admin'  => 'admin',
                    'status' => 'status',
                ]
            ]
        );

        return view('admin.managements.languages.index', compact('datatables'));

    }//end of index

    public function data()
    {
        $permissions = [
            'status' => 'status-languages',
            'update' => 'update-languages',
            'delete' => 'delete-languages',
        ];

        $language   = Language::all();

        return dataTables()->of($language)
            ->addColumn('record_select', 'admin.dataTables.record_select')
            ->addColumn('created_at', fn (Language $language) => $language?->created_at?->format('Y-m-d'))
            ->addColumn('admin', fn (Language $language) => $language?->admin?->name)
            ->addColumn('actions', function(Language $language) use($permissions) {
                $routeEdit   = route('admin.managements.languages.edit', 1);
                $routeDelete = route('admin.managements.languages.destroy', 1);
                return view('admin.dataTables.actions', compact('permissions', 'routeEdit', 'routeDelete'));
            })
            ->addColumn('status', function(Language $language) use($permissions) {
                $models = $language;
                return view('admin.dataTables.status', compact('models', 'permissions'));
            })
            ->addColumn('default', function(Language $language) {
                return view('admin.managements.languages.data_tables.check_default', compact('language'));
            })
            ->rawColumns(['record_select', 'actions', 'status'])
            ->addIndexColumn()
            ->toJson();

    }//end of data

    public function create(): View
    {
        $types = LanguageType::array();

        return view('admin.managements.languages.create', compact('types'));
        
    }//end of create

    public function store(LanguageRequest $request): RedirectResponse
    {
        Language::create($request->validated());

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.managements.languages.index');

    }//end of store

    public function edit(Language $language): View
    {
        $types = LanguageType::array();

        return view('admin.managements.languages.create', compact('language', 'types'));

    }//end of edit

    public function update(CategoryRequest $request, Language $language): RedirectResponse
    {
        $language->update($request->validated());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.managements.languages.index');
        
    }//end of update

    public function delete()
    {
        
    }//end of delete

    public function bulkDelete(DeleteRequest $request)
    {
        Category::destroy(json_decode(request()->record_ids));

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));
        
    }//end of bulkDelete

    public function status(StatusRequest $request)
    {
        $language = Language::find($request->id);
        $language?->update(['status' => !$language->status]);

        session()->flash('success', __('site.updated_successfully'));
        return response(__('site.updated_successfully'));
        
    }//end of status

    public function changeDefault(StatusRequest $request)
    {
        $languages = Language::all();
        $languages->each(fn ($language) => $language->update(['default' => 0]));
        Language::find($request->id)->update(['default' => 1]);

        session()->flash('success', __('site.updated_successfully'));
        return response(__('site.updated_successfully'));
        
    }//end of status

}//end of controller