<?php

namespace App\Http\Controllers;

use App\Models\SystemNotification;
use App\Models\User;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $now = now();
        $startOfMonth = $now->copy()->startOfMonth();
        $startOfWeek = $now->copy()->startOfWeek();

        $totalBusinesses = User::role('business_admin')->count();
        $newBusinessesThisMonth = User::role('business_admin')
            ->where('created_at', '>=', $startOfMonth)
            ->count();

        $totalCustomers = User::role('customer')->count();
        $newCustomersThisWeek = User::role('customer')
            ->where('created_at', '>=', $startOfWeek)
            ->count();

        $activeCashiers = User::role('cashier')
            ->where('status', 'active')
            ->count();

        $systemAlerts = SystemNotification::count();

        $kpis = [
            [
                'label' => 'Total Businesses',
                'value' => number_format($totalBusinesses),
                'icon' => 'bx bx-buildings',
                'color' => 'primary',
                'badge' => '+' . $newBusinessesThisMonth . ' this month',
                'badge_class' => $newBusinessesThisMonth > 0 ? 'success' : 'secondary',
                'link' => route('admin.businesses'),
                'link_text' => 'View all businesses',
            ],
            [
                'label' => 'Total Customers',
                'value' => number_format($totalCustomers),
                'icon' => 'bx bx-user',
                'color' => 'warning',
                'badge' => '+' . $newCustomersThisWeek . ' this week',
                'badge_class' => $newCustomersThisWeek > 0 ? 'success' : 'secondary',
                'link' => route('admin.users.index'),
                'link_text' => 'Customer user list',
            ],
            [
                'label' => 'Active Cashiers',
                'value' => number_format($activeCashiers),
                'icon' => 'bx bx-id-card',
                'color' => 'success',
                'badge' => 'Live status',
                'badge_class' => 'success',
                'link' => route('admin.users.index'),
                'link_text' => 'Cashier user list',
            ],
            [
                'label' => 'System Alerts',
                'value' => number_format($systemAlerts),
                'icon' => 'bx bx-bell',
                'color' => 'info',
                'badge' => 'From notifications',
                'badge_class' => 'info',
                'link' => route('admin.audit-logs'),
                'link_text' => 'Audit logs',
            ],
        ];

        $recentBusinessUsers = User::role('business_admin')
            ->latest()
            ->take(5)
            ->get(['id', 'name', 'email', 'status', 'created_at']);

        $recentActivities = SystemNotification::query()
            ->latest()
            ->take(6)
            ->get(['message', 'type', 'created_at']);

        return view('admin.dashboard', [
            'kpis' => $kpis,
            'recentBusinessUsers' => $recentBusinessUsers,
            'recentActivities' => $recentActivities,
            'planBreakdown' => [9, 11, 4],
        ]);
    }
}
