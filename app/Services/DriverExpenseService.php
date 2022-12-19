<?php

namespace App\Services;

use Illuminate\Database\Console\DumpCommand;

use function GuzzleHttp\Promise\each;

class DriverExpenseService
{
    public function calculateDriverExpenses(array $drivers, array $expenses)
    {
        $result=[];
        $result["data"] = [];
        $total = 0;
        dump($expenses);
        foreach ($expenses as $price) {
            $total += $price;
        }
        $total1 = 0;
        $total2 = 0;
        foreach ($expenses as $price) {
            $math = $price * 100;
            $soloPrice = $price /count($drivers);
            if ($math % 2 == 1) {
                if ($total1 == $total2) {
                    $firstDriver = $soloPrice + 0.005;
                    $secondDriver = $soloPrice- 0.005;
                    $total1 += $firstDriver;
                    $total2 += $secondDriver;
                }
                else{
                    $firstDriver = $soloPrice - 0.005;
                    $secondDriver = $soloPrice+ 0.005;
                    $total1 += $firstDriver;
                    $total2 += $secondDriver;
                }
            } else {
                $firstDriver = $soloPrice;
                $secondDriver = $soloPrice;
                $total1 += $firstDriver;
                $total2 += $secondDriver;
            }
            $each = [$drivers[0] => $firstDriver, $drivers[1] => $secondDriver];
            array_push($result["data"], $each);
            $eachTotal = [$drivers[0] => $total1, $drivers[1] => $total2];
            

        }
        $result["totals"]= $eachTotal;
        return $result;
    }
}
