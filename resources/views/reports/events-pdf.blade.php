<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agenda de Salones de Eventos</title>
    <!-- Favicon -->
    <?php $admin_favicon = Voyager::setting('admin.icon_image', ''); ?>
    @if($admin_favicon == '')
        <link rel="shortcut icon" href="{{ asset('images/icon.png') }}" type="image/png">
    @else
        <link rel="shortcut icon" href="{{ Voyager::image($admin_favicon) }}" type="image/png">
    @endif
</head>
<body>
    <table width="100%" style="margin-bottom: 3px">
        <tr>
            <td width="150px">
                <img src="{{ asset('images/logo2021.png') }}" width="100px" alt="logo">
            </td>
            <td align="right">
                <h3 style="margin: 0px; margin-bottom: 10px">
                    GOBIERNO AUTÓNOMO DEPARTAMENTAL DEL BENI <br>
                    <small>AGENDA DE SALONES DE EVENTOS</small> <br>
                    <small>{{ $range }}</small>
                </h3>
            </td>
        </tr>
    </table>
    <div style="margin-top: 20px">
        <table width="100%" border="1" cellpadding="3" cellspacing="0">
            <thead>
                <tr>
                    <th width="60px">N&deg;</th>
                    <th>Fecha</th>
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
                        <td>
                            {{ date('d/m/Y', strtotime($item->start)) }}
                            <br>
                            @if (date('H:i', strtotime($item->start)) != '00:00' && date('H:i', strtotime($item->finish)) != '00:00')
                            <small>{{ date('h:i a', strtotime($item->start)) }}</small>
                            @else
                            <small>Hora no definida</small>
                            @endif
                        </td>
                        <td>
                            <table width="100%">
                                <tr>
                                    <td width="100px"><b>Nombre</b></td>
                                    <td>:</td>
                                    <td>{{ $item->name }}</td>
                                </tr>
                                <tr>
                                    <td><b>Descripción</b></td>
                                    <td>:</td>
                                    <td>{{ $item->description ?? 'No definida' }}</td>
                                </tr>
                                <tr>
                                    <td><b>Lugar</b></td>
                                    <td>:</td>
                                    <td>{{ $item->events_room->name }}</td>
                                </tr>
                                <tr>
                                    <td><b>Solicitante</b></td>
                                    <td>:</td>
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
                        <td colspan="3"><h4 class="text-center text-muted">No hay eventos agendados</h4></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pie de página --}}
    <div style="position: fixed; bottom: 0px; right: 10px; text-align: right">
        <p style="font-size: 12px">Fecha y hora de impresión: {{ date('d/m/Y H:i:s') }} <br> <small style="font-size: 11px">Por: {{ Auth::user()->name }}</small></p>
    </div>

    <style>
        body{
            margin: 0px;
            padding: 0px
        }
        .bordered{
            border: 1px solid black
        }
    </style>
</body>
</html>