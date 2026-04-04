<?php 

namespace App\Controllers;

use App\Models\Order_model;

class Sales extends BaseController {

    public function index() {
        $orderModel = model(Order_model::class);

        // 1. Daily Revenue (Sales subong nga adlaw)
        $daily = $orderModel->selectSum('total_amount')
                            ->where('date(order_date)', date('Y-m-d'))
                            ->first();

        // 2. Monthly Orders (Count sang orders subong nga bulan)
        $monthlyCount = $orderModel->where('MONTH(order_date)', date('m'))
                                   ->where('YEAR(order_date)', date('Y'))
                                   ->countAllResults();

        // 3. Total Transactions (Kabilugan nga customers/orders)
        $totalCustomers = $orderModel->countAllResults();

        // 4. Data para sa Chart (Last 7 Days Sales)
        // Ini nagakuha sang sales data per day para sa graph
        $chartData = $orderModel->select("DATE_FORMAT(order_date, '%D %b') as day, SUM(total_amount) as amount")
                                ->groupBy('day')
                                ->orderBy('order_date', 'ASC')
                                ->limit(7)
                                ->findAll();

        $data = [
            'daily_revenue'  => $daily['total_amount'] ?? 0,
            'monthly_orders' => $monthlyCount,
            'total_orders'   => $totalCustomers,
            'chart_labels'   => array_column($chartData, 'day'),
            'chart_values'   => array_column($chartData, 'amount'),
            'title'          => 'Riverside | Sales Analytics'
        ];

        return view('sales_view', $data);
    }
}