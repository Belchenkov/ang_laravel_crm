<?php

namespace App\Modules\Admin\Dashboard\Controllers;

use App\Modules\Admin\Dashboard\Classes\Base;

class DashboardController extends Base
{
    public function index()
    {
        $this->title = __("admin.dashboard_title_page");
        $this->content = view('Admin::Dashboard.index')
            ->with([
                'title' => $this->title
            ])
            ->render();

        return $this->renderOutput();
    }
}
