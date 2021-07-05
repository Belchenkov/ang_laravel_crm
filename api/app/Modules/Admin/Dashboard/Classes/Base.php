<?php


namespace App\Modules\Admin\Dashboard\Classes;


use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Menu;
use App\Modules\Admin\Menu\Models\Menu as MenuModel;

class Base extends Controller
{
    protected $template;
    protected $user;
    protected $title;
    protected $content;
    protected $vars;
    protected $sidebar;
    protected $locale;

    public function __construct()
    {
        $this->template = "Admin::Dashboard.dashboard";

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            $this->locale = App::getLocale();

            return $next($request);
        });
    }

    protected function renderOutput()
    {
        $menu = $this->getMenu();

        $this->sidebar = view('Admin::layouts.parts.sidebar')
            ->with([
                'menu' => $menu,
                'user' => $this->user
            ])
            ->render();

        $this->vars = Arr::add($this->vars, 'content', $this->content);
        $this->vars = Arr::add($this->vars, 'sidebar', $this->sidebar);

        return view($this->template)->with($this->vars);
    }

    private function getMenu()
    {
        return Menu::make('menuRenderer', function ($m) {
            foreach (MenuModel::menuByType(MenuModel::MENU_TYPE_ADMIN)->get() as $item) {
                $path = $item->path;

                if ($path && $this->checkRoute($path)) {
                    $path = route($path);
                }
            }
        });
    }
}
