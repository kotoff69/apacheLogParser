<table class="table mt-3">
    <thead class="thead-dark">
    <tr>
        <th scope="col">IP</th>
        <th scope="col">Date</th>
        <th scope="col">Request</th>
        <th scope="col">Status</th>
        <th scope="col">Size (bytes)</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $ip => $items)
        @foreach ($items as $item)
        <tr>
            @if($loop->first)
                <th rowspan="{{ count($items) }}" scope="row">{{ $ip }}</th>
            @endif
            <td>{{ $item->date_time->format('Y.m.d H:i:s') }}</td>
            <td>{{ $item->path }}</td>
            <td>{{ $item->status }}</td>
            <td>{{ $item->bytes }}</td>
        </tr>
        @endforeach
    @endforeach
    </tbody>
</table>