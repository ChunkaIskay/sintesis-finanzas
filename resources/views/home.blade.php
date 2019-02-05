@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="container">
            @if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <ul id="contract-list">
                @foreach($contracts as $contract)
                    <li>
                            <div class="data">
                                {{ $contract->code }}
                            </div>

                    </li>
                @endforeach
            </ul>
        </div>
        {{ $contracts->links() }}

    </div>
</div>
@include('includes.footer')
@endsection
