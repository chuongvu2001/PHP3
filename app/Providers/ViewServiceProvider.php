<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.sidebar', function ($view) {
            $menus = [
                [
                    "url" => route('homepage'),
                    'text' => "Dashboard",
                    "hasChild" => false,
                    "icon" => "nav-icon fas fa-tachometer-alt"
                ],
                [
                    "text" => "Danh mục",
                    "hasChild" => true,
                    "icon" => "nav-icon fas fa-list",
                    "childs" => [
                        [
                            "text" => "Danh sách",
                            "url" => route('cate.index')
                        ],
                        [
                            "text" => "Tạo mới",
                            "url" => route('cate.add')
                        ]
                    ]
                ],
                [
                    "text" => "Sản phẩm",
                    "hasChild" => true,
                    "icon" => "nav-icon fas fa-truck",
                    "childs" => [
                        [
                            "text" => "Danh sách",
                            "url" => route('cate.index')
                        ],
                        [
                            "text" => "Tạo mới",
                            "url" => route('cate.add')
                        ]
                    ]
                ]
            ];
            $view->with('menus', $menus);
        });
    }
}
