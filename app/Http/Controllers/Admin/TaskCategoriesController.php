<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TaskCategory\BulkDestroyTaskCategory;
use App\Http\Requests\Admin\TaskCategory\DestroyTaskCategory;
use App\Http\Requests\Admin\TaskCategory\IndexTaskCategory;
use App\Http\Requests\Admin\TaskCategory\StoreTaskCategory;
use App\Http\Requests\Admin\TaskCategory\UpdateTaskCategory;
use App\Models\TaskCategory;
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
use App\Models\TaskSection;

class TaskCategoriesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexTaskCategory $request
     * @return array|Factory|View
     */
    public function index(IndexTaskCategory $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(TaskCategory::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'parent_id'],

            // set columns to searchIn
            ['id', 'name', 'section.name'],

            function ($query) use ($request)
            {
                $query->with(['section']);
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

        return view('admin.task-category.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.task-category.create');
        $sections = TaskSection::all();
        return view('admin.task-category.create', ['sections' => $sections]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTaskCategory $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreTaskCategory $request)
    {

        // Sanitize input
        $sanitized = $request->getSanitized();
        // Store the TaskCategory
        $taskCategory = TaskCategory::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/task-categories'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/task-categories');
    }

    /**
     * Display the specified resource.
     *
     * @param TaskCategory $taskCategory
     * @throws AuthorizationException
     * @return void
     */
    public function show(TaskCategory $taskCategory)
    {
        $this->authorize('admin.task-category.show', $taskCategory);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TaskCategory $taskCategory
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(TaskCategory $taskCategory)
    {
//        dd($taskCategory->section);
        $this->authorize('admin.task-category.edit', $taskCategory);

        $sections = TaskSection::all();

        return view('admin.task-category.edit', [
            'taskCategory' => $taskCategory,
            'sections' => $sections
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTaskCategory $request
     * @param TaskCategory $taskCategory
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateTaskCategory $request, TaskCategory $taskCategory)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values TaskCategory
        $taskCategory->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/task-categories'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/task-categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyTaskCategory $request
     * @param TaskCategory $taskCategory
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyTaskCategory $request, TaskCategory $taskCategory)
    {
        $taskCategory->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyTaskCategory $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyTaskCategory $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    TaskCategory::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
