<?php

namespace App\Modules\Admin\Role\Controllers;

use App\Modules\Admin\Dashboard\Classes\Base;
use App\Modules\Admin\Role\Models\Permission;
use App\Modules\Admin\Role\Models\Role;
use App\Modules\Admin\Role\Services\PermService;
use Illuminate\Http\Request;

class PermissionsController extends Base
{
    public function __construct(PermService $permService)
    {
        parent::__construct();

        $this->service = $permService;
    }

    public function index()
    {
        $this->authorize('view', Role::class);

        $perms = Permission::all();
        $roles = Role::all();

        $this->title = "Title Permissions index";
        $this->content = view('Admin::Permission.index')
            ->with([
                'perms' => $perms,
                'roles' => $roles,
                'title' => $this->title
            ])
            ->render();

        return $this->renderOutput();
    }

    public function store(Request $request)
    {
        $this->authorize('create', Role::class);

        $this->service->save($request);

        return back()->with([
                'message' => __('Success')
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
