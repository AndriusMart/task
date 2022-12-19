<?php

namespace App\Services;

class DriverExpenseService
{
    public function calculateDriverExpenses(array $drivers, array $expenses)
    {
        $total = 0;
        foreach ($expenses as $price) {
            $total += $price;
        }
        $each = $total / count($drivers);
        //will work fine just with 2 drivers.
        if ($each != number_format($each, 2, '.', '')) {
            $firstDriver = number_format($each, 2, '.', '');
            $secondDriver = number_format($each, 2, '.', '') - 0.01;
            $eachTotal = [$drivers[0]=> $firstDriver, $drivers[1]=> $secondDriver];
        } else {
            $firstDriver = $each;
            $secondDriver = $each;
            $eachTotal = [$drivers[0]=> $firstDriver, $drivers[1]=> $secondDriver];
        }
        return $eachTotal;
    }
}
