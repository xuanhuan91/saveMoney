<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\expense;
use App\Models\income;
use Illuminate\Support\Facades\Auth;
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
        $category = $this->getByCategory($input);
        return view('report.month', [
            'data' => $result,
            'chart' => $chartData,
            'category' => $category,
        ]);
    }

    public function reportByWeek(Request $request)
    {
        $result = null;
        $input = $this->transformRequest($request);
        $input['weekReport'] = true;
        if (!empty($request->expenseReport)) {
            $result = $this->expenseReport($input)
                ->with('categoryExpense')
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
        $category = $this->getByCategory($input);
        return view('report.week', [
            'data' => $result,
            'chart' => $chartData,
            'category' => $category,
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

    public function getByCategory(array $input)
    {
        $output = null;
        $filter['month'] = Carbon::now()->month;
        $select = [DB::raw('COUNT(*) as total')];
        if (!empty($input['expenseReport'])) {
            $output = $this->expenseReport($filter)
                ->join('category_expenses', 'category_expenses.id', '=', 'expenses.categoryIncomeId')
                ->groupBy('categoryExpenseId');
            array_push($select, 'categoryExpenseId', 'category_expenses.name');
        } else {
            $output = $this->incomeReport($filter)
                ->join('category_incomes', 'category_incomes.id', '=', 'incomes.categoryIncomeId')
                ->groupBy('categoryIncomeId');
            array_push($select, 'categoryIncomeId', 'category_incomes.name');
        }

        return $output->addSelect($select)->get();
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
        $output['month'] = Carbon::now()->month;
        return $output;
    }

    public function incomeReport(array $input)
    {
        $user = Auth::user();
        $query = income::where('incomes.userId', $user->id);
        // nếu check theo tuần
        if (!empty($input['weekReport'])) {
            return $query->whereBetween('incomes.updated_at', [$input['startOfWeek'], $input['endOfWeek']]);
        }
        // mặc định theo tháng
        return $query->whereMonth('incomes.updated_at', $input['month']);
    }

    public function expenseReport(array $input)
    {
        $user = Auth::user();
        $query = expense::where('expenses.userId', $user->id);
        // nếu check theo tuần
        if (!empty($input['weekReport'])) {
            return $query->whereBetween('expenses.updated_at', [$input['startOfWeek'], $input['endOfWeek']]);
        }
        // mặc định theo tháng
        return $query->whereMonth('expenses.updated_at', $input['month']);
    }
}
