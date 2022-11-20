<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Price\BulkDestroyPrice;
use App\Http\Requests\Admin\Price\DestroyPrice;
use App\Http\Requests\Admin\Price\IndexPrice;
use App\Http\Requests\Admin\Price\StorePrice;
use App\Http\Requests\Admin\Price\UpdatePrice;
use App\Models\Price;
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

class PricesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexPrice $request
     * @return array|Factory|View
     */
    public function index(IndexPrice $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Price::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'service', 'cost'],

            // set columns to searchIn
            ['id', 'service']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.price.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.price.create');

        return view('admin.price.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePrice $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StorePrice $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Price
        $price = Price::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/prices'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/prices');
    }

    /**
     * Display the specified resource.
     *
     * @param Price $price
     * @throws AuthorizationException
     * @return void
     */
    public function show(Price $price)
    {
        $this->authorize('admin.price.show', $price);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Price $price
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Price $price)
    {
        $this->authorize('admin.price.edit', $price);


        return view('admin.price.edit', [
            'price' => $price,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePrice $request
     * @param Price $price
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdatePrice $request, Price $price)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Price
        $price->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/prices'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/prices');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyPrice $request
     * @param Price $price
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyPrice $request, Price $price)
    {
        $price->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyPrice $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyPrice $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Price::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
