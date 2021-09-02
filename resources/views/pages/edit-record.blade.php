<form id="form-edit" class="wow animated fadeIn p-3 m-0" 
      method="POST" enctype="multipart/form-data"
      action="{{ url('records/update/' . $type . '?id='. $id) }}">
    {{ csrf_field() }}
    <div class="md-form form-sm mt-0">
        <div class="input-group">
            <div class="custom-file">
                <input class="custom-file-input" id="attachment" name="attachment[]" 
                       aria-describedby="attachment" type="file" multiple>
                <label class="custom-file-label" for="attachment">
                    <i class="fas fa-file-import"></i> Add attachments
                </label>
            </div>
        </div>
    </div>

    <div class="md-form form-sm">
        <select id="record-type" name="record_type" 
                class="browser-default custom-select">
            @if (count($recordTypes) > 0)
                @foreach ($recordTypes as $rType)
                    @if ($rType->id != 1)
            <option value="{{ $rType->id }}" 
                    {{ $recordType->id == $rType->id ? 'selected': '' }}>
                Record Type: {{ $rType->type }}
            </option>
                    @endif
                @endforeach
            @endif
        </select>
    </div>

    <div class="md-form form-sm">
        <i class="{{ $recordType->fa_icon }} prefix"></i>
        <input type="text" id="record-title" name="record_title" 
               class="form-control form-control-sm" value="{{ $title }}" required>
        <label for="record-title" {{ !empty($title) ? 'class=active': '' }}>
            {{ $recordType->type == 'Announcement' ? $recordType->type: 'Title' }}
        </label>
    </div>

    <div class="md-form form-sm">
        <i class="fas fa-font prefix"></i>
        <input type="text" id="record-subject" name="record_subject" 
               class="form-control form-control-sm" value="{{ $subject }}">
        <label for="record-subject" {{ !empty($subject) ? 'class=active': '' }}>
            Subject
        </label>
    </div>

    <div class="md-form form-sm">
        <i class="fa fa-pencil-alt prefix"></i>
        <textarea type="text" id="record-remarks" name="record_remarks" 
                  class="md-textarea form-control">{{ $remarks }}</textarea>
        <label for="record-remarks" {{ !empty($remarks) ? 'class=active': '' }}>
            Remarks
        </label>
    </div>

    <div class="md-form form-sm">
        <i class="far fa-calendar-alt prefix"></i>
        <input type="date" id="record-date-due" name="record_date_due" 
               class="form-control form-control-sm" value="{{ $dateDue }}">
        <label for="record-date-due" {{ !empty($dateDue) ? 'class=active': '' }}>
            Due Date
        </label>
    </div>

    <input type="hidden" id="form-action" value="{{ url('records/update/' . $type . '?id='. $id) }}">
    <input type="hidden" id="delete-url" value="{{ url('records/delete/' . $id) }}">
</form>

<hr>

<div class="md-form form-sm mt-0">
    <div class="well border p-2">
        @if (!empty($attachment))
        <p>File Attachment/s:</p>
        @foreach($attachments as $fileCtr => $file)
        <a onclick="$(this).deleteAttachment('{{ $id }}', '{{ $file->filename }}', 
                                             'attachment-{{ $fileCtr }}');"
           id="attachment-{{ $fileCtr }}" class="btn-link btn-sm btn-block red-text">
            Click to delete "{{ $file->filename }}"
        </a>
        @endforeach
        <hr>
        @endif

        <p>Link Attachment/s:</p>
        <select name="url_attachment[]" id="url-attachment" multiple="multiple">
            @if (count($attachmentURLs) > 0)
                @foreach ($attachmentURLs as $url)
            <option value="{{ $url }}" selected>{{ $url }}</option>        
                @endforeach
            @endif
        </select>

        @if (empty($attachment) && empty($attachmentURL))
        <p class="red-text">No attachment/s</p>
        @endif
    </div>
</div>