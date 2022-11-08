<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FooterTitle\BulkDestroyFooterTitle;
use App\Http\Requests\Admin\FooterTitle\DestroyFooterTitle;
use App\Http\Requests\Admin\FooterTitle\IndexFooterTitle;
use App\Http\Requests\Admin\FooterTitle\StoreFooterTitle;
use App\Http\Requests\Admin\FooterTitle\UpdateFooterTitle;
use App\Models\FooterTitle;
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

class FooterTitlesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexFooterTitle $request
     * @return array|Factory|View
     */
    public function index(IndexFooterTitle $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(FooterTitle::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name'],

            // set columns to searchIn
            ['id', 'name']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.footer-title.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.footer-title.create');

        return view('admin.footer-title.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFooterTitle $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreFooterTitle $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();
        $sanitized['name'] = [
            'ua' => $request->get('ua'),
            'en' => $request->get('en'),
            'cz' => $request->get('cz'),
        ];
        // Store the FooterTitle
        $footerTitle = FooterTitle::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/footer-titles'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/footer-titles');
    }

    /**
     * Display the specified resource.
     *
     * @param FooterTitle $footerTitle
     * @throws AuthorizationException
     * @return void
     */
    public function show(FooterTitle $footerTitle)
    {
        $this->authorize('admin.footer-title.show', $footerTitle);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param FooterTitle $footerTitle
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(FooterTitle $footerTitle)
    {
        $this->authorize('admin.footer-title.edit', $footerTitle);


        return view('admin.footer-title.edit', [
            'footerTitle' => $footerTitle,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFooterTitle $request
     * @param FooterTitle $footerTitle
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateFooterTitle $request, FooterTitle $footerTitle)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values FooterTitle
        $footerTitle->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/footer-titles'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/footer-titles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyFooterTitle $request
     * @param FooterTitle $footerTitle
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyFooterTitle $request, FooterTitle $footerTitle)
    {
        $footerTitle->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyFooterTitle $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyFooterTitle $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    FooterTitle::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
