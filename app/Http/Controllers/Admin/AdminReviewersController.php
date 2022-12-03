<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminReviewer\BulkDestroyAdminReviewer;
use App\Http\Requests\Admin\AdminReviewer\DestroyAdminReviewer;
use App\Http\Requests\Admin\AdminReviewer\IndexAdminReviewer;
use App\Http\Requests\Admin\AdminReviewer\StoreAdminReviewer;
use App\Http\Requests\Admin\AdminReviewer\UpdateAdminReviewer;
use App\Models\AdminReviewer;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminReviewersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexAdminReviewer $request
     * @return array|Factory|View
     */
    public function index(IndexAdminReviewer $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(AdminReviewer::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'profession', 'review', 'avatar'],

            // set columns to searchIn
            ['id', 'name', 'profession', 'review', 'avatar']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.admin-reviewer.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.admin-reviewer.create');

        return view('admin.admin-reviewer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAdminReviewer $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreAdminReviewer $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();
        if($request->hasFile('avatar')) {
            $file = $request->file('avatar');

            $imageName = time().'.'.str_replace(' ', '_', $file->getClientOriginalName());

            $file->storeAs('public/images/',$imageName);
            $sanitized['avatar'] = $imageName;
        }
        // Store the AdminReviewer
        $adminReviewer = AdminReviewer::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/admin-reviewers'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/admin-reviewers');
    }

    /**
     * Display the specified resource.
     *
     * @param AdminReviewer $adminReviewer
     * @throws AuthorizationException
     * @return void
     */
    public function show(AdminReviewer $adminReviewer)
    {
        $this->authorize('admin.admin-reviewer.show', $adminReviewer);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param AdminReviewer $adminReviewer
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(AdminReviewer $adminReviewer)
    {
        $this->authorize('admin.admin-reviewer.edit', $adminReviewer);


        return view('admin.admin-reviewer.edit', [
            'adminReviewer' => $adminReviewer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAdminReviewer $request
     * @param AdminReviewer $adminReviewer
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateAdminReviewer $request)
    {
        $adminReviewer = AdminReviewer::find($request->id);
        // Sanitize input
        $sanitized = $request->getSanitized();
        if($request->hasFile('avatar')) {
            Storage::delete('public/images/' . $adminReviewer->avatar);

            $file = $request->file('avatar');

            $imageName = time().'.'.str_replace(' ', '_', $file->getClientOriginalName());

            $file->storeAs('public/images/',$imageName);
            $sanitized['avatar'] = $imageName;
        }
        // Update changed values AdminReviewer
        $adminReviewer->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/admin-reviewers'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/admin-reviewers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyAdminReviewer $request
     * @param AdminReviewer $adminReviewer
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyAdminReviewer $request, AdminReviewer $adminReviewer)
    {
        $adminReviewer->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyAdminReviewer $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyAdminReviewer $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    AdminReviewer::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
