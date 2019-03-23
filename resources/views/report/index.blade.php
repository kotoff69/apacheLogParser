@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{ route('report') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="start_date">Start date</label>
                <input class="form-control" value="{{ old('start_date') }}" name="start_date" id="start_date" placeholder="Y-m-d">
            </div>
            @if ($errors->has('start_date'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('start_date') }}
                </div>
            @endif
            <div class="form-group">
                <label for="end_date">End date</label>
                <input class="form-control" value="{{ old('end_date') }}" name="end_date" id="end_date" placeholder="Y-m-d">
            </div>
            @if ($errors->has('end_date'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('end_date') }}
                </div>
            @endif
            <div class="form-group">
                <label for="type">Group by</label>
                <select class="form-control" name="type" id="type">
                    <option value="{{ \App\Http\Controllers\HomeController::GROUP_IP }}">IP</option>
                    <option value="{{ \App\Http\Controllers\HomeController::GROUP_DATE }}">Date</option>
                </select>
            </div>
            @if ($errors->has('type'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('type') }}
                </div>
            @endif
            <input type="submit" class="btn btn-primary" value="Search" />
        </form>
        @if (!$list)
            <div class="alert alert-warning mt-3" role="alert">
                No results.
            </div>
        @else
            @if($request->post('type') == \App\Http\Controllers\HomeController::GROUP_IP)
                @include('report.group_ip_table', $list)
            @elseif($request->post('type') == \App\Http\Controllers\HomeController::GROUP_DATE)
                @include('report.group_date_table', $list)
            @endif
        @endif
    </div>
@endsection
