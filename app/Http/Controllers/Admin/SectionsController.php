<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Section\BulkDestroySection;
use App\Http\Requests\Admin\Section\DestroySection;
use App\Http\Requests\Admin\Section\IndexSection;
use App\Http\Requests\Admin\Section\StoreSection;
use App\Http\Requests\Admin\Section\UpdateSection;
use App\Models\Section;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SectionsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexSection $request
     * @return array|Factory|View
     */
    public function index(IndexSection $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Section::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            [''],

            // set columns to searchIn
            ['']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.section.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.section.create');

        return view('admin.section.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSection $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreSection $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Section
        $section = Section::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/sections'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/sections');
    }

    /**
     * Display the specified resource.
     *
     * @param Section $section
     * @throws AuthorizationException
     * @return void
     */
    public function show(Section $section)
    {
        $this->authorize('admin.section.show', $section);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Section $section
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Section $section)
    {
        $this->authorize('admin.section.edit', $section);


        return view('admin.section.edit', [
            'section' => $section,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSection $request
     * @param Section $section
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateSection $request, Section $section)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Section
        $section->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/sections'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/sections');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroySection $request
     * @param Section $section
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroySection $request, Section $section)
    {
        $section->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroySection $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroySection $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Section::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
