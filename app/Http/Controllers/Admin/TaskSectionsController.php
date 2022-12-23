<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TaskSection\BulkDestroyTaskSection;
use App\Http\Requests\Admin\TaskSection\DestroyTaskSection;
use App\Http\Requests\Admin\TaskSection\IndexTaskSection;
use App\Http\Requests\Admin\TaskSection\StoreTaskSection;
use App\Http\Requests\Admin\TaskSection\UpdateTaskSection;
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
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TaskSectionsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexTaskSection $request
     * @return array|Factory|View
     */
    public function index(IndexTaskSection $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(TaskSection::class)->processRequestAndGet(
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

        return view('admin.task-section.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.task-section.create');

        return view('admin.task-section.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTaskSection $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreTaskSection $request)
    {
        $sanitized = $request->getSanitized();
        $sanitized['name'] = [
            'ua' => $request->get('ua'),
            'en' => $request->get('en'),
            'cz' => $request->get('cz'),
        ];
        if($request->hasFile('image')) {
            $file = $request->file('image');

            $imageName = time().'.'.str_replace(' ', '_', $file->getClientOriginalName());

            $file->storeAs('public/images/',$imageName);
            $sanitized['image'] = $imageName;
        }
            // Store the TaskSection
        $taskSection = TaskSection::create($sanitized);

        $taskSection->save();

        if ($request->ajax()) {
            return ['redirect' => url('admin/task-sections'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/task-sections');
    }

    /**
     * Display the specified resource.
     *
     * @param TaskSection $taskSection
     * @throws AuthorizationException
     * @return void
     */
    public function show(TaskSection $taskSection)
    {
        $this->authorize('admin.task-section.show', $taskSection);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TaskSection $taskSection
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(TaskSection $taskSection)
    {
        $this->authorize('admin.task-section.edit', $taskSection);


        return view('admin.task-section.edit', [
            'taskSection' => $taskSection,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTaskSection $request
     * @param TaskSection $taskSection
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateTaskSection $request, TaskSection $taskSection)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();
        $sanitized['name'] = [
            'ua' => $request->get('ua'),
            'en' => $request->get('en'),
            'cz' => $request->get('cz'),
        ];
        if($request->hasFile('image')) {
            Storage::delete('public/images/' . $taskSection->image);

            $file = $request->file('image');

            $imageName = time().'.'.str_replace(' ', '_', $file->getClientOriginalName());

            $file->storeAs('public/images/',$imageName);
            $sanitized['image'] = $imageName;
        }
        // Update changed values TaskSection
        $taskSection->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/task-sections'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/task-sections');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyTaskSection $request
     * @param TaskSection $taskSection
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyTaskSection $request, TaskSection $taskSection)
    {
        $taskSection->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyTaskSection $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyTaskSection $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    TaskSection::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
