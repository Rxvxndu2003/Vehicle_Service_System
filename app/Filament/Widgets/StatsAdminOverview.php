<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\Appointments;
use App\Models\Inventory;
use App\Models\Product;


class StatsAdminOverview extends BaseWidget
{

    protected function getStats(): array
    {
        return [
            Stat::make('Customers', Customer::query()->count())
                ->description('All Customers from the WebSite')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            Stat::make('Vehicles', Vehicle::query()->count())
                ->description('All Registered Vehicles from the WebSite')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            Stat::make('Appointments',Appointments::query()->count())
                ->description('All Appointments from the WebSite')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            Stat::make('Products',Product::query()->count())
                ->description('All Products from the WebSite')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17])
        ];
    }
}
