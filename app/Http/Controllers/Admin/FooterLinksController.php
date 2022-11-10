<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FooterLink\BulkDestroyFooterLink;
use App\Http\Requests\Admin\FooterLink\DestroyFooterLink;
use App\Http\Requests\Admin\FooterLink\IndexFooterLink;
use App\Http\Requests\Admin\FooterLink\StoreFooterLink;
use App\Http\Requests\Admin\FooterLink\UpdateFooterLink;
use App\Models\FooterLink;
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

class FooterLinksController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexFooterLink $request
     * @return array|Factory|View
     */
    public function index(IndexFooterLink $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(FooterLink::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'footer_title_id', 'link'],

            // set columns to searchIn
            ['id', 'name', 'link'],

            function ($query) use ($request)
            {
                $query->with(['title']);
            }
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.footer-link.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.footer-link.create');
        $footerTitles = FooterTitle::all();
        return view('admin.footer-link.create', ['footerTitles' => $footerTitles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFooterLink $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreFooterLink $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();
        $sanitized['name'] = [
            'ua' => $request->get('ua'),
            'en' => $request->get('en'),
            'cz' => $request->get('cz'),
        ];
        // Store the FooterLink
        $footerLink = FooterLink::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/footer-links'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/footer-links');
    }

    /**
     * Display the specified resource.
     *
     * @param FooterLink $footerLink
     * @throws AuthorizationException
     * @return void
     */
    public function show(FooterLink $footerLink)
    {
        $this->authorize('admin.footer-link.show', $footerLink);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param FooterLink $footerLink
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(FooterLink $footerLink)
    {
        $this->authorize('admin.footer-link.edit', $footerLink);
        $footerTitles = FooterTitle::all();
        
        return view('admin.footer-link.edit', [
            'footerLink' => $footerLink,
            'footerTitles' => $footerTitles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFooterLink $request
     * @param FooterLink $footerLink
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateFooterLink $request, FooterLink $footerLink)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();
        $sanitized['name'] = [
            'ua' => $request->get('ua'),
            'en' => $request->get('en'),
            'cz' => $request->get('cz'),
        ];
        // Update changed values FooterLink
        $footerLink->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/footer-links'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/footer-links');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyFooterLink $request
     * @param FooterLink $footerLink
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyFooterLink $request, FooterLink $footerLink)
    {
        $footerLink->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyFooterLink $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyFooterLink $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    FooterLink::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
