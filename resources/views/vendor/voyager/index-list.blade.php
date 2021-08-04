<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="60px">N&deg;</th>
                            <th>Detalle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $cont = 1;
                        @endphp
                        @forelse ($reg as $item)
                            <tr>
                                <td>{{ $cont }}</td>
                                <td style="padding: 0px">
                                    <table class="table">
                                        <tr>
                                            <td width="100px"><b>Fecha</b></td>
                                            <td>
                                                {{ date('d/m/Y', strtotime($item->start)) }}
                                                <br>
                                                @if (date('H:i', strtotime($item->start)) != '00:00' && date('H:i', strtotime($item->finish)) != '00:00')
                                                <small>{{ date('h:i a', strtotime($item->start)) }} a {{ date('h:i a', strtotime($item->finish)) }}</small>
                                                @else
                                                <small>Hora no definida</small>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Título</b></td>
                                            <td>{{ $item->topic }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Descripción</b></td>
                                            <td>{{ $item->description ?? 'No definida' }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Lugar</b></td>
                                            <td>{{ $item->place }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Solicitante</b></td>
                                            <td>{{ $item->applicant }}</td>
                                        </tr>
                                    </table>
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
<style>
    b{
        font-weight: 600 !important
    }
</style>