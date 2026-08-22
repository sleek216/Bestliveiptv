<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SystemExportController extends Controller
{
    public function download(): StreamedResponse
    {
        $fileName = 'system-backup-' . now()->format('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $columns = [
            'User ID',
            'User Name',
            'User Email',
            'User Phone',
            'User Country',
            'User Created At',
            'Total Orders By User',
            'Total Spent By User',
            'Order Number',
            'Order Date',
            'Package Name',
            'Package Duration',
            'Order Amount',
            'Payment Method',
            'Payment Status',
            'Order Status',
            'Order Active',
            'Selected Countries',
            'Expires At',
        ];

        return response()->stream(function () use ($columns) {
            $handle = fopen('php://output', 'w');

            // UTF-8 BOM so Excel shows UTF-8 characters correctly.
            fwrite($handle, "\xEF\xBB\xBF");
            fputcsv($handle, $columns);

            User::query()
                ->where('is_admin', false)
                ->with(['orders.package', 'orders.countries'])
                ->withCount('orders')
                ->orderBy('id')
                ->chunk(100, function ($users) use ($handle) {
                    foreach ($users as $user) {
                        $totalSpentByUser = (float) $user->orders->sum('amount');

                        if ($user->orders->isEmpty()) {
                            fputcsv($handle, [
                                $user->id,
                                $user->name,
                                $user->email,
                                $user->phone,
                                $user->country,
                                optional($user->created_at)->format('Y-m-d H:i:s'),
                                (int) $user->orders_count,
                                number_format($totalSpentByUser, 2, '.', ''),
                                '',
                                '',
                                '',
                                '',
                                '',
                                '',
                                '',
                                '',
                                '',
                                '',
                                '',
                            ]);

                            continue;
                        }

                        foreach ($user->orders as $order) {
                            fputcsv($handle, [
                                $user->id,
                                $user->name,
                                $user->email,
                                $user->phone,
                                $user->country,
                                optional($user->created_at)->format('Y-m-d H:i:s'),
                                (int) $user->orders_count,
                                number_format($totalSpentByUser, 2, '.', ''),
                                $order->order_number,
                                optional($order->created_at)->format('Y-m-d H:i:s'),
                                $order->package->name ?? 'N/A',
                                $order->package->duration_label ?? '',
                                number_format((float) $order->amount, 2, '.', ''),
                                $order->payment_method,
                                $order->payment_status,
                                $order->order_status,
                                $order->is_active ? 'Yes' : 'No',
                                $order->countries->pluck('name')->implode(', '),
                                optional($order->expires_at)->format('Y-m-d H:i:s'),
                            ]);
                        }
                    }
                });

            fclose($handle);
        }, 200, $headers);
    }
}
