<?php


namespace App\Modules\Admin\Dashboard\Classes;


use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class Base extends Controller
{
    protected $template;
    protected $user;
    protected $title;
    protected $content;
    protected $vars;

    public function __construct()
    {
        $this->template = "Admin::Dashboard.index";

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }

    protected function renderOutput()
    {
        $this->vars = Arr::add($this->vars, 'content', $this->content);

        return view($this->template)->with($this->vars);
    }

    private function getMenu()
    {

    }
}
