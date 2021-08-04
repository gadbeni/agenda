<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h3 class="text-muted">Agenda de eventos <br> <small>{{ $range }}</small></h3>
                        </div>
                        <div class="col-md-4 text-right">
                            <div class="btn-group" role="group" aria-label="...">
                                {{-- <button type="button" class="btn btn-primary">Imprimir <i class="voyager-polaroid"></i></button> --}}
                                <button type="button" class="btn btn-danger" onclick="generate_pdf()">PDF <i class="voyager-file-text"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="60px">N&deg;</th>
                                    <th>Fecha</th>
                                    <th>Detalle</th>
                                    <th>Asistente(s)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $cont = 1;
                                @endphp
                                @forelse ($reg as $item)
                                    <tr>
                                        <td>{{ $cont }}</td>
                                        <td width="150px">
                                            {{ date('d/m/Y', strtotime($item->start)) }}
                                            <br>
                                            @if (date('H:i', strtotime($item->start)) != '00:00' && date('H:i', strtotime($item->finish)) != '00:00')
                                            <small>{{ date('h:i a', strtotime($item->start)) }} a {{ date('h:i a', strtotime($item->finish)) }}</small>
                                            @else
                                            <small>Hora no definida</small>
                                            @endif
                                        </td>
                                        <td>
                                            <table width="100%">
                                                <tr>
                                                    <td width="100px"><b>Título</b></td>
                                                    <td>:</td>
                                                    <td>{{ $item->topic }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Descripción</b></td>
                                                    <td>:</td>
                                                    <td>{{ $item->description ?? 'No definida' }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Lugar</b></td>
                                                    <td>:</td>
                                                    <td>{{ $item->place }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Solicitante</b></td>
                                                    <td>:</td>
                                                    <td>{{ $item->applicant }}</td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <ul>
                                                @foreach ($item->details as $detail)
                                                    <li>{{ $detail->assistant->full_name }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                    @php
                                        $cont++;
                                    @endphp
                                    @empty
                                    <tr>
                                        <td colspan="4"><h4 class="text-center text-muted">No hay eventos agendados</h4></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    b{
        font-weight: 600 !important
    }
</style>