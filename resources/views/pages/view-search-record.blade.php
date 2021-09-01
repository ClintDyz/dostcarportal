<div class="wow animated fadeIn">
    @if (count($recordTypes) > 0)
        @foreach ($recordTypes as $rTypeCtr => $rType)
            @if (count($records[$rTypeCtr]) > 0)
    <p class="grey-text mb-1" style="font-size: 11pt;">
        <i>Result for "{{ $rType->type }}"...</i>
    </p>
    <table class="table table-hover table-bordered table-sm m-0 mb-1">
        <thead>
            <tr>
                <th class="table-txt text-center" width="2%">
                    <strong>#</strong>
                </th>
                <th class="table-txt text-center" width="38%">
                    <strong>
                        {{ $rType->type == 'Announcement' ? $rType->type: 'Title' }}
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
                @foreach ($records[$rTypeCtr] as $itmCtr => $record)
                    @if ($record->record_type == $rType->id)
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
                    @endif
                @endforeach
        </tbody>
    </table>
    <hr>
            @endif
        @endforeach
    <p align="middle" class="grey-text mb-1" style="font-size: 10pt;">
        --------------------- End Result ---------------------
    </p>
    @else
    <p class="red-text">No result found.</p>
    @endif
</div>
