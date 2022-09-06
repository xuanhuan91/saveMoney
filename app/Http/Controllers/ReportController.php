<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\expense;
use App\Models\income;

class ReportController extends Controller
{
    CONST LIMIT = 10;

    public function index(Request $request)
    {
        $result = null;
        $input = $request->only(['weekReport']);
        if (!empty($request->incomeReport)) {
            $result = $this->incomeReport($input);
        }
        $result = $this->exposeReport($input);

        return $result->paginate(self::LIMIT);
    }

    public function incomeReport(array $input)
    {
        if (!empty($input['weekReport'])) {
            return income::all();
        }
        return income::all();
    }

    public function expenseReport(array $input)
    {
        if (!empty($input['weekReport'])) {
            return expense::all();
        }
        return expense::all();
    }
}
