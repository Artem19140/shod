<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::query()
            ->with(['user'])
            ->whereNull('deleted_at')
            ->paginate();
            
        return view('reports.index', [
            'reports' => $reports
        ]);
    }

    public function create()
    {
        return view('reports.create', [
            'types' => Report::types()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'report' => ['required', 'file'],
            'type' => ['required', 'in:weekly,monthly,quarterly,annual,adhoc']
        ]);

        $file = $request->file('report');

        Report::create([
            'path' => $file->store(),
            'size' => $file->getSize(),
            'user_id' => $request->user()->id,
            'original_file_name' => $file->getClientOriginalName(),
            'type' => $request->input('type')
        ]);

        return redirect()->route('reports.index');
    }

    public function destroy(Report $report, Request $request)
    {
        Gate::allowIf($request->user()->id === $report->user_id, 'not found', 404);

        $report->update([
            'deleted_at' =>  Carbon::now()
        ]);

        return redirect()->route('reports.index');
    }
}
