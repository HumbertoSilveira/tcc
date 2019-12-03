@extends('adminlte::page')

@section('content_header')
    <h1>Logs <small>do sistema</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Página Inicial</a></li>
        <li class="active">Log de erros do sistema</li>
    </ol>
@endsection

@push('css')
<style>
    .table-container tbody tr td {
        vertical-align: middle;
    }
</style>
@endpush

@section('content')
    @component('components.box')
        @slot('type', 'primary')
        @slot('icon', 'calendar')
        @slot('title', "Logs encontrados")
        @slot('body_class', 'no-padding')

        @slot('actions')
            <a href="?clean={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}" class="btn btn-flat bg-maroon btn-sm sweetConfirm">
                <i class="fa fa-refresh fa-fw"></i> Limpar arquivo
            </a>
        @endslot

        @php
            $results = collect();
            if(!is_null($logs) && $standardFormat) {
                $collection = collect($logs);

                $page = request()->has('page') ? request('page') : 1;
                $perPage = 30;

                $results = new Illuminate\Pagination\LengthAwarePaginator($collection->forPage($page, $perPage), $collection->count(), $perPage, $page,  ['path' => route('log')]);
            }
        @endphp

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover no-margin grid-table table-container">
                <thead>
                <tr>
                    <th width="1" class="text-center">Tipo</th>
                    <th class="text-center">Ambiente</th>
                    <th class="text-center">Data</th>
                    <th>Texto</th>
                </tr>
                </thead>
                <tbody>
                    @forelse($results as $key => $log)
                        <tr data-display="stack{{ $key }}">
                            <td class="text-{{ $log['level_class'] }} text-center">
                                <i class="fa fa-{{ $log['level_img'] }}"></i><br>{{$log['level']}}
                            </td>
                            <td class="text-center">{{ $log['context'] }}</td>
                            <td nowrap="nowrap" class="text-center">{{ isset($log['date']) && $log['date'] != '1' ? \Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $log['date'])->format('d/m/Y - H:i:s'): "" }}</td>
                            <td>
                                <div class="log-text">
                                    {{ str_limit($log['text'], 220) }}
                                </div>
                                @if (isset($log['in_file']))
                                    <div class="log-file">
                                        {{ $log['in_file']}}
                                    </div>
                                @endif
                                @if ($log['stack'])
                                    <div class="stack" id="stack{{ $key }}"
                                         style="display: none; white-space: pre-wrap;">{{ trim($log['stack']) }}
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">{{ config('app.messages.grid.empty') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($results->count())
            @slot('footer')
                {{-- PAGINAÇÃO --}}
                <div class="text-right">
                    {{ $results->appends(request()->except('page'))->links() }}
                </div>
            @endslot
        @endif
    @endcomponent

@endsection


@push('js')
<script>
    $(document).ready(function () {
        $('.table-container tr').on('click', function () {
            $('#' + $(this).data('display')).toggle();
        });

        $('.sweetConfirm').on('click', function(e){
            e.preventDefault();
            var $this = $('.sweetConfirm');

            swal({
                title: "Limpar arquivo de log?",
                text: "Essa ação é irreversível!",
                type: "question",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Cancelar",
                confirmButtonText: "Limpar",
                reverseButtons: true
            }).then(function(result){
                if (result.value) {
                    window.location.href = $this.attr('href');
                }
            });
        });

    });
</script>
@endpush