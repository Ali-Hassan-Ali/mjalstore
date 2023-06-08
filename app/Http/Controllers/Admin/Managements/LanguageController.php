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
                    'site.flag',
                    'site.code',
                    'site.default',
                    'site.admin',
                    'site.status',
                ],
                'columns' => [
                    'name'   => 'name',
                    'dir'    => 'dir',
                    'flag'   => 'flag',
                    'code'   => 'code',
                    'default'=> 'default',
                    'admin'  => 'admin',
                    'status' => 'status',
                ]
            ]
        );

        return view('admin.managements.languages.index', compact('datatables'));

    }//end of index

    public function data(): object
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
            ->editColumn('flag', function(Language $language) {
                return view('admin.dataTables.image', ['models' => $language]);
            })
            ->addColumn('actions', function(Language $language) use($permissions) {
                $routeEdit   = route('admin.managements.languages.edit', $language->id);
                $routeDelete = '';
                if(!$language->default) {
                    $routeDelete = route('admin.managements.languages.destroy', $language->id);
                }
                return view('admin.dataTables.actions', compact('permissions', 'routeEdit', 'routeDelete'));
            })
            ->addColumn('status', function(Language $language) use($permissions) {
                if(!$language->default) {
                    return view('admin.dataTables.status', ['models' => $language, 'permissions' => $permissions]);
                }
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
        if(!permissionAdmin('create-languages')) {
            return abort(403);
        }

        $types = LanguageType::array();

        return view('admin.managements.languages.create', compact('types'));
        
    }//end of create

    //RedirectResponse
    public function store(LanguageRequest $request): RedirectResponse
    {
        $requestData = request()->except(['flag']);

        if(request()->file('flag')) {

            $requestData['flag'] = request()->file('flag')->store('languages', 'public');

        }

        Language::create($requestData);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.managements.languages.index');

    }//end of store

    public function edit(Language $language): View
    {
        if(!permissionAdmin('update-languages')) {
            return abort(403);
        }
        
        $types = LanguageType::array();

        return view('admin.managements.languages.edit', compact('language', 'types'));

    }//end of edit

    public function update(LanguageRequest $request, Language $language): RedirectResponse
    {
        $requestData = request()->except(['flag']);

        if(request()->has('flag')) {

            $language->flag ? Storage::disk('public')->delete($language->flag) : '';

            $requestData['flag'] = request()->file('flag')->store('languages', 'public');

        }

        $language->update($requestData);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.managements.languages.index');
        
    }//end of update

    public function destroy(Language $language): Application | Response | ResponseFactory
    {
        if(!$language->default) {

            $language->flag ? Storage::disk('public')->delete($language->flag) : '';
            $language->delete();
        }

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }//end of delete

    public function bulkDelete(DeleteRequest $request)
    {
        $images = Language::where('default', 0)->find(request()->ids ?? [])->pluck('flag')->toArray();
        Storage::disk('public')->delete($images) ?? '';
        Language::where('default', 0)->destroy(request()->ids ?? []);

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }//end of bulkDelete

    public function status(StatusRequest $request): Application | Response | ResponseFactory
    {
        $language = Language::find($request->id);
        $language?->update(['status' => !$language->status]);

        session()->flash('success', __('site.updated_successfully'));
        return response(__('site.updated_successfully'));
        
    }//end of status

    public function changeDefault(StatusRequest $request): Application | Response | ResponseFactory
    {
        $languages = Language::all();
        $languages->each(fn ($language) => $language->update(['default' => 0]));
        Language::find($request->id)->update(['default' => 1, 'status' => 1]);

        session()->flash('success', __('site.updated_successfully'));
        return response(__('site.updated_successfully'));
        
    }//end of status

}//end of controller