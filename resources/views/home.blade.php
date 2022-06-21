@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
                        <a class="nav-link" href="{{route('import_export')}}">
                            <i class="fa fa-fw fa-area-chart"></i>
                                <span class="nav-link-text">Import/Export</span>
                         </a>
                     </li>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
