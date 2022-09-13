<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\expense;
use App\Models\income;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    CONST LIMIT = 10;

    public function reportByMonth(Request $request)
    {
        $result = null;
        $input = $this->transformRequest($request);
        if (!empty($request->expenseReport)) {
            $result = $this->expenseReport($input)
                ->with('categoryExpense.subcategory')
                ->latest()
                ->paginate(self::LIMIT);
            $result->appends(['expenseReport' => true]);
        } else {
            $result = $this->incomeReport($input)
                ->with('categoryIncome')
                ->latest()
                ->paginate(self::LIMIT);
        }
        $chartData = $this->getWeekReport($input);
        return view('report.month', [
            'data' => $result,
            'chart' => $chartData
        ]);
    }

    public function reportByWeek(Request $request)
    {
        $result = null;
        $input = $this->transformRequest($request);
        $input['weekReport'] = true;
        if (!empty($request->expenseReport)) {
            $result = $this->expenseReport($input)
                ->with('categoryExpense.subcategory')
                ->latest()
                ->paginate(self::LIMIT);
            $result->appends(['expenseReport' => true]);
        } else {
            $result = $this->incomeReport($input)
                ->with('categoryIncome')
                ->latest()
                ->paginate(self::LIMIT);
        }
        $chartData = $this->getDayReport($input);
        return view('report.week', [
            'data' => $result,
            'chart' => $chartData
        ]);
    }


    public function getWeekReport(array $input)
    {
        $output = null;
        if (!empty($input['expenseReport'])) {
            $output = $this->expenseReport($input);
        } else {
            $output = $this->incomeReport($input);
        }

        return $output->groupBy('date')
            ->select(DB::raw('WEEK(updated_at) as date'), DB::raw('SUM(amount) as total'))
            ->get();
    }

    public function getDayReport(array $input)
    {
        $output = null;
        if (!empty($input['expenseReport'])) {
            $output = $this->expenseReport($input);
        } else {
            $output = $this->incomeReport($input);
        }

        return $output->groupBy('date')
            ->select(DB::raw('DATE(updated_at) as date'), DB::raw('SUM(amount) as total'))
            ->get();
    }

    public function transformRequest(Request $request)
    {
        $now = Carbon::now();
        $output = $request->only(['expenseReport']);
        $output['startOfWeek'] = $now->startOfWeek()->format('Y-m-d H:i');
        $output['endOfWeek'] = $now->endOfWeek()->format('Y-m-d H:i');
        $output['month'] = $now->month;
        return $output;
    }

    public function incomeReport(array $input)
    {
        $query = income::query();
        if (!empty($input['weekReport'])) {
            return $query->whereBetween('updated_at', [$input['startOfWeek'], $input['endOfWeek']]);
        }
        return $query->whereMonth('updated_at', $input['month']);
    }

    public function expenseReport(array $input)
    {
        $query = expense::query();
        if (!empty($input['weekReport'])) {
            return $query->whereBetween('updated_at', [$input['startOfWeek'], $input['endOfWeek']]);
        }
        return $query->whereMonth('updated_at', $input['month']);
    }
}
