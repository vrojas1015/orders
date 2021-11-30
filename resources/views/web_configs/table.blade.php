<div class="table-responsive">
    <table class="table" id="webConfigs-table">
        <thead>
        <tr>
            <th>Logo</th>
            <th>Address</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($webConfigs as $webConfig)
            <tr>
                <td> <a href="{{ asset($webConfig->logo) }}" target="_blank">Logo</a></td>
                <td>{{ $webConfig->address }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['webConfigs.destroy', $webConfig->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <span><i class="fi fi-rr-Trash"></i></span>



                        {!! Form::button('<i class="fa fa-close"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
