<table class="table table-bordered">
    <thead>
    <tr>
        <th rowspan="2">{{ __('grade') }}</th>
        <th colspan="3">{{ __('quality') }}</th>
        <th colspan="2">{{ __('total') }}</th>
    </tr>
    <tr>
        <th>{{ __('bad') }}</th>
        <th>{{ __('good') }}</th>
        <th>{{ __('excellent') }}</th>

        <th>{{ __('grades') }}</th>
        <th>{{ __('percentage') }}</th>
    </tr>

    </thead>
    <tbody>
    @foreach(range(1, 11) as $class)
        <tr>
            <td>{{ $class }}</td>

            <td>{{ $rates->whereBetween('score', [0, 50])->where('grade', $class)->count() }}</td>
            <td>{{ $rates->whereBetween('score', [50, 75])->where('grade', $class)->count() }}</td>
            <td>{{ $rates->whereBetween('score', [75, 100])->where('grade', $class)->count() }}</td>

            <td>{{$rates->where("grade", $class)->count()}}</td>
            <td>{{ round($rates->where("grade", $class)->avg("score")  ?? 0, 2) }}%</td>
        </tr>
    @endforeach
    </tbody>
</table>
