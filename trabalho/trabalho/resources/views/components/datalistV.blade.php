<div>

    <table class="table align-middle caption-top table-striped">
        <caption>Tabela de <b>Vínculos</b></caption>
        <thead>
        <tr>
            @php $cont=0; @endphp
            @foreach ($header as $item)

                @if($hide[$cont])
                    <th scope="col" class="d-none d-md-table-cell">{{ $item }}</th>
                @else
                    <th scope="col">{{ $item }}</th>
                @endif
                @php $cont++; @endphp

            @endforeach
        </tr>
        </thead>
        <tbody>
            @foreach ($data[0] as $item)
                <tr>
                    @foreach ($data[2] as $dis)
                        @if($dis['id'] == $item['id_disciplina'])
                        <td class="d-none d-md-table-cell">{{ $dis['nome'] }}</td>
                    @endif
                    @endforeach

                    @foreach ($data[1] as $prof)
                        @if($prof['id'] == $item['id_professor'])
                        <td class="d-none d-md-table-cell">{{ $prof['nome'] }}</td>
                    @endif
                    @endforeach

                </tr>
            @endforeach
        </tbody>
    </table>

</div>