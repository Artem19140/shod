<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'date_from' => ['nullable', 'date'],
            'date_to' => ['nullable', 'date'],
            'type' => ['nullable', 'in:weekly,monthly,quarterly,annual,adhoc'],
            'organization' => ['nullable  ', 'exists:organizations,id'],
            'author' => ['nullable  ', 'exists:users,id']
        ]);
        $reports = Report::query()
            ->with(['user', 'organization'])
            ->whereNull('deleted_at')
            ->when(request('date_from'), function(Builder $query, $dateFrom) {
                return $query->where('created_at', '>=',Carbon::parse($dateFrom)->startOfDay());
            })
            ->when(request('date_to'), function(Builder $query, $dateTo) {
                return $query->where('created_at', '<=',Carbon::parse($dateTo)->endOfDay());
            })
            ->when(request('type'), function(Builder $query, $type) {
                return $query->where('type', $type);
            })
            ->when(request('organization'), function(Builder $query, $organization) {
                return $query->where('organization_id', $organization);
            })
            ->when(request('author'), function(Builder $query, $author) {
                return $query->where('user_id', $author);
            })
            ->paginate();
            
        return view('reports.index', [
            'reports' => $reports,
            'organizations' => Organization::whereNull('deleted_at')->get(),
            'types' => Report::types(),
            'users' => User::all()
        ]);
    }

    public function create()
    {
        return view('reports.create', [
            'types' => Report::types(),
            'organizations' => Organization::whereNull('deleted_at')->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'report' => ['required', 'file'],
            'type' => ['required', 'in:weekly,monthly,quarterly,annual,adhoc'],
            'organization' => ['required', 'exists:organizations,id']
        ]);

        $file = $request->file('report');

        Report::create([
            'path' => $file->store(),
            'size' => $file->getSize(),
            'user_id' => $request->user()->id,
            'original_file_name' => $file->getClientOriginalName(),
            'type' => $request->input('type'),
            'organization_id'=>$request->input('organization'),
        ]);

        return redirect()->route('reports.index');
    }

    public function destroy(Report $report, Request $request)
    {
        Gate::allowIf($request->user()->id === $report->user_id, 'not found', 404);
        Log::info($report->deleted_at);
        $report->update([
            'deleted_at' =>  Carbon::now()
        ]);
        $report->refresh();
        Log::info($report->deleted_at); 
        return redirect()->route('reports.index');
    }
}
