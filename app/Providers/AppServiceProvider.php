<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Order;
use App\Models\Demande_revendeur;
use App\Http\Controllers\ProductController;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        view()->composer('*', function ($view) {
            $now = Carbon::now();
            $last24Hours = $now->copy()->subDay();

            $ordersGroupedByRedOrder = Order::select(
                    'orders.red_order',
                    DB::raw('COUNT(DISTINCT orders.red_order) as count'),
                    DB::raw('SUM(orders.quantite_produit) as products_count')
                )
                ->join('products', 'orders.id_produit', '=', 'products.id')
                ->where('orders.created_at', '>=', $last24Hours)
                ->where('orders.status', '=', 'encours')
                ->groupBy('orders.red_order')
                ->get();

            $messagesCount = Demande_revendeur::where('created_at', '>=', $last24Hours)->count();

            $view->with([
                'ordersGroupedByRedOrder' => $ordersGroupedByRedOrder,
                'messagesCount' => $messagesCount,
            ]);
        });

        View::composer('dashboard.components.header', function ($view) {
            $stockNotifications = ProductController::getNotifications();
            $view->with('stockNotifications', $stockNotifications);
        });
    }
}
