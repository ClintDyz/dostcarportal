<div class="wow animated fadeIn">
    <table class="table table-hover table-bordered table-fixed table-sm m-0">
        <thead>
            <tr>
                <th class="table-txt text-center" width="2%">
                    <strong>#</strong>
                </th>
                <th class="table-txt text-center" width="38%">
                    <strong>
                        {{ $recordType->type == 'Announcement' ? $recordType->type: 'Title' }}
                    </strong>
                </th>
                <th class="table-txt text-center" width="15%">
                    <strong>Subject</strong>
                </th>
                <th class="table-txt text-center" width="15%">
                    <strong>Due Date</strong>
                </th>
                <th class="table-txt text-center" width="15%">
                    <strong>Remarks</strong>
                </th>
                <th class="table-txt text-center" width="15%">
                    <strong>Posted By</strong>
                </th>
            </tr>
        </thead>
        <tbody>
            @if (count($records) > 0)
                @foreach ($records as $itmCtr => $record)
            <tr onclick="$(this).showView('{{ $record->id }}', 'record', '{{ $record->record_type }}');"
                class="cursor-pointer">
                <td class="table-txt text-center">{{ $itmCtr + 1 }}</td>
                <td class="table-txt">{{ $record->title }}</td>
                <td class="table-txt">{{ $record->subject }}</td>
                <td class="table-txt text-center">
                    {{ $record->date_due != '0000-00-00' ? $record->date_due: 'N/a' }}
                </td>
                <td class="table-txt">{{ $record->remarks }}</td>
                <td class="table-txt">{{ $record->user }}</td>
            </tr>
                @endforeach
            @else
            <tr>
                <td colspan="6" class="text-danger">
                    <center>
                        <strong>There is no record/s.</strong>
                    </center>
                </td>
            </tr>
            @endif
        </tbody>
    </table>

    @include('pagination', ['paginator' => $records,
                            'contentID' => '#' . $recElemID . '-content'])
</div>


