<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ApplicationsLink\BulkDestroyApplicationsLink;
use App\Http\Requests\Admin\ApplicationsLink\DestroyApplicationsLink;
use App\Http\Requests\Admin\ApplicationsLink\IndexApplicationsLink;
use App\Http\Requests\Admin\ApplicationsLink\StoreApplicationsLink;
use App\Http\Requests\Admin\ApplicationsLink\UpdateApplicationsLink;
use App\Models\ApplicationsLink;
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

class ApplicationsLinksController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexApplicationsLink $request
     * @return array|Factory|View
     */
    public function index(IndexApplicationsLink $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(ApplicationsLink::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'url'],

            // set columns to searchIn
            ['id', 'name', 'url']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.applications-link.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.applications-link.create');

        return view('admin.applications-link.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreApplicationsLink $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreApplicationsLink $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the ApplicationsLink
        $applicationsLink = ApplicationsLink::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/applications-links'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/applications-links');
    }

    /**
     * Display the specified resource.
     *
     * @param ApplicationsLink $applicationsLink
     * @throws AuthorizationException
     * @return void
     */
    public function show(ApplicationsLink $applicationsLink)
    {
        $this->authorize('admin.applications-link.show', $applicationsLink);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ApplicationsLink $applicationsLink
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(ApplicationsLink $applicationsLink)
    {
        $this->authorize('admin.applications-link.edit', $applicationsLink);


        return view('admin.applications-link.edit', [
            'applicationsLink' => $applicationsLink,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateApplicationsLink $request
     * @param ApplicationsLink $applicationsLink
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateApplicationsLink $request, ApplicationsLink $applicationsLink)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values ApplicationsLink
        $applicationsLink->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/applications-links'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/applications-links');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyApplicationsLink $request
     * @param ApplicationsLink $applicationsLink
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyApplicationsLink $request, ApplicationsLink $applicationsLink)
    {
        $applicationsLink->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyApplicationsLink $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyApplicationsLink $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    ApplicationsLink::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
