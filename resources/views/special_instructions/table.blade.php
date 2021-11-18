<div class="table-responsive">
    <table class="table" id="specialInstructions-table">
        <thead>
        <tr>
            <th>Order Id</th>
        <th>Instruction</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($specialInstructions as $specialInstruction)
            <tr>
                <td>{{ $specialInstruction->order_id }}</td>
            <td>{{ $specialInstruction->instruction }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['specialInstructions.destroy', $specialInstruction->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('specialInstructions.show', [$specialInstruction->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('specialInstructions.edit', [$specialInstruction->id]) }}"
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
