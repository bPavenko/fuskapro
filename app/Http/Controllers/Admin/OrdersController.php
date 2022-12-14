<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\BulkDestroyOrder;
use App\Http\Requests\Admin\Order\DestroyOrder;
use App\Http\Requests\Admin\Order\IndexOrder;
use App\Http\Requests\Admin\Order\StoreOrder;
use App\Http\Requests\Admin\Order\UpdateOrder;
use App\Models\Order;
use App\Models\TaskCategory;
use App\Models\TaskSection;
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
use Illuminate\Http\Request;
use Igaster\LaravelCities\Geo;

class OrdersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexOrder $request
     * @return array|Factory|View
     */
    public function index(IndexOrder $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Order::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'section_id', 'category_id', 'short_description', 'full_description', 'execution_date', 'start_execution_time', 'end_execution_time', 'price', 'by_user', 'price_negotiable'],

            // set columns to searchIn
            ['id', 'short_description', 'full_description']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.order.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.order.create');
        $sections = TaskSection::all();
        return view('admin.order.create', ['sections' => $sections]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrder $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreOrder $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();
        // Store the Order
        $order = Order::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/orders'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/orders');
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @throws AuthorizationException
     * @return void
     */
    public function show(Order $order)
    {
        $this->authorize('admin.order.show', $order);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Order $order
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Order $order)
    {
        $this->authorize('admin.order.edit', $order);

        $sections = TaskSection::all();
        $categories = TaskCategory::where('parent_id', $order->section_id)->get();
        $order->categories = $categories;
        $order->city_name = Geo::where('id', $order->city)->first()->name;

        return view('admin.order.edit', [
            'order' => $order,
            'sections' => $sections
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOrder $request
     * @param Order $order
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateOrder $request, Order $order)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();
        // Update changed values Order
        $order->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/orders'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/orders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyOrder $request
     * @param Order $order
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyOrder $request, Order $order)
    {
        $order->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyOrder $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyOrder $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Order::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }

    public function getCategories(Request $request) {
        $results = [];
        $categories = TaskCategory::where('parent_id', $request->section_id)->get();
        foreach ($categories as $category) {
            $results[] = [
                'name' => $category->name,
                'id' => $category->id,
            ];
        }
        return response()->json($results);
    }

    public function getCities(Request $request) {
        $term = $request->get('query');
        $results = [];
        $cities = Geo::where('name', 'like', '%' . $term . '%')->orderBy('population', 'desc')->limit(10)->get();

        foreach ($cities as $city) {
            $results[] = [
                'name' => $city->name,
                'id' => $city->id,
            ];
        }
        return response()->json($results);
    }
}
