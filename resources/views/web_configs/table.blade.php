<div class="table-responsive">
    <table class="table" id="webConfigs-table">
        <thead>
        <tr>
            <th>Logo</th>
        <th>Address</th>
        <th>Header-Image-Bg</th>
        <th>Footer-Image-Bg</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($webConfigs as $webConfig)
            <tr>
                <td>{{ $webConfig->logo }}</td>
            <td>{{ $webConfig->address }}</td>
            <td>{{ $webConfig->header-image-bg }}</td>
            <td>{{ $webConfig->footer-image-bg }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['webConfigs.destroy', $webConfig->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('webConfigs.show', [$webConfig->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('webConfigs.edit', [$webConfig->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
