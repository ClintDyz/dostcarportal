<form class="wow animated fadeIn pl-3 pr-3 pt-0 m-0">
    <div class="md-form form-sm mt-0 mb-2 float-right">
        @if (Auth::user())
        <button type="button" class="btn btn-link btn-lg p-2 orange-text"
                onclick="$(this).showEdit('{{ $id }}', 'record', '{{ $type }}')">
            <i class="far fa-edit"></i> Edit
        </button>
        @endif
    </div><br>
    <div class="md-form form-sm">
        <i class="{{ $recordType->fa_icon }} prefix"></i>
        <input type="text" id="announcement-name" name="announcement_name" 
               class="form-control form-control-sm" value="{{ $title }}" readonly>
        <label for="announcement-name" class="active">
            {{ $recordType->type == 'Announcement' ? $recordType->type: 'Title' }}
        </label>
    </div>

    <div class="md-form form-sm">
        <i class="fas fa-font prefix"></i>
        <input type="text" id="announcement-subject" name="announcement_subject" 
               class="form-control form-control-sm" value="{{ $subject }}" readonly>
        <label for="announcement-subject" class="active">
            Subject
        </label>
    </div>

    <div class="md-form form-sm">
        <i class="fas fa-keyboard prefix"></i>
        <input type="text" id="announcement-type" name="announcement_type" 
               class="form-control form-control-sm" value="{{ $recType }}" readonly>
        <label for="announcement-type" class="active">
            Type
        </label>
    </div>

    <div class="md-form form-sm">
        <i class="fa fa-pencil-alt prefix"></i>
        <textarea type="text" id="announcement-remarks" name="announcement_remarks" 
                  class="md-textarea form-control" readonly>{{ $remarks }}</textarea>
        <label for="infosys-desc" class="active">
            Remarks
        </label>
    </div>

    <div class="md-form form-sm">
        <i class="far fa-calendar-alt prefix"></i>
        <input type="date" id="announcement-duedate" name="announcement_duedate" 
               class="form-control form-control-sm" value="{{ $dateDue }}" readonly>
        <label for="announcement-duedate" class="active">
            Due Date
        </label>
    </div>

    <hr>

    <div class="md-form form-sm">
        <i class="far fa-user prefix"></i>
        <input type="text" id="announcement-posted-by" name="announcement_posted_by" 
               class="form-control form-control-sm" value="{{ $postedBy }}" readonly>
        <label for="announcement-posted-by" class="active">
            Posted By
        </label>
    </div>

    <div class="md-form form-sm">
        <i class="far fa-calendar-alt prefix"></i>
        <input type="text" id="announcement-created-at" name="announcement_created_at" 
               class="form-control form-control-sm" value="{{ $createdAt }}" readonly>
        <label for="announcement-created-at" class="active">
            Posted At
        </label>
    </div>

    <hr>

    <div class="md-form form-sm mt-0">
        <div class="well border p-2">
            @if (!empty($attachment))
            <p>Attachment/s:</p>
            @foreach($attachments as $file)
            <a class="btn-link btn-sm btn-block" target="_blank" 
               href="{{ asset($file->directory) }}" download>
                {{ $file->filename }}
            </a>
            @endforeach
            @else
            <p class="red-text">No attachment/s</p>
            @endif
        </div>
    </div>
</form>