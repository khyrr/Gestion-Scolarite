@extends('admin.layouts.dashboard')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>{{ __('app.activity_logs') }}</h1>
        <div>
            <a class="btn btn-outline-secondary" href="{{ route('admin.logs.export', request()->query()) }}">{{ __('app.export_csv') }}</a>
        </div>
    </div>

    <form id="filterForm" method="GET" action="{{ route('admin.logs.index') }}" class="mb-3">
        <div class="row g-2">
            <div class="col-md-2"><input class="form-control" name="user_type" placeholder="{{ __('app.user_type') }}" value="{{ request('user_type') }}"></div>
            <div class="col-md-2"><input class="form-control" name="action" placeholder="{{ __('app.action') }}" value="{{ request('action') }}"></div>
            <div class="col-md-3"><input class="form-control" name="search" placeholder="{{ __('app.search') }}" value="{{ request('search') }}"></div>
            <div class="col-md-2"><input type="date" class="form-control" name="from" value="{{ request('from') }}"></div>
            <div class="col-md-2"><input type="date" class="form-control" name="to" value="{{ request('to') }}"></div>
            <div class="col-md-1"><button class="btn btn-primary w-100" type="submit">{{ __('app.filter') }}</button></div>
        </div>
    </form>

    <x-table.data-table :title="__('app.activity_logs')" :showSearch="false" serverFormId="filterForm">
            <table class="google-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('app.user') }}</th>
                        <th>{{ __('app.action') }}</th>
                        <th>{{ __('app.resource') }}</th>
                        <th>{{ __('app.description') }}</th>
                        <th>{{ __('app.ip') }}</th>
                        <th>{{ __('app.user_agent') }}</th>
                        <th>{{ __('app.time') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                    <tr>
                        <td>{{ $log->id }}</td>
                        <td>{{ $log->user_type }} #{{ $log->user_id }}</td>
                        <td>{{ $log->action }}</td>
                        <td>{{ $log->resource }} {{ $log->resource_id }}</td>
                        <td style="max-width:300px">{{ Str::limit($log->description, 120) }}</td>
                        <td>{{ $log->ip_address }}</td>
                        <td>{{ Str::limit($log->user_agent, 60) }}</td>
                        <td>{{ $log->created_at }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="8">{{ __('app.aucun_journal') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @slot('footer')
            {{ $logs->links() }}
        @endslot
    </x-table.data-table>

@endsection
