<form id="form-create-record" class="wow animated fadeIn m-0" 
      method="POST" enctype="multipart/form-data"
      action="{{ url('records/store/' . $type) }}">
    {{ csrf_field() }}
    <div class="md-form form-sm mt-0">
        <div class="input-group">
            <div class="custom-file">
                <input class="custom-file-input" id="attachment" name="attachment[]" 
                       aria-describedby="attachment" type="file" multiple>
                <label class="custom-file-label" for="attachment">
                    <i class="fas fa-file-import"></i> Choose file attachments
                </label>
            </div>
        </div>
    </div>

    <select name="url_attachment[]" id="url-attachment" multiple="multiple"></select>

    <div class="md-form form-sm">
        <i class="{{ $recordType->fa_icon }} prefix"></i>
        <input type="text" id="record-title" name="record_title" 
               class="form-control form-control-sm" required>
        <label for="record-title">
            {{ $recordType->type == 'Announcement' ? $recordType->type: 'Title' }}
        </label>
    </div>

    <div class="md-form form-sm">
        <i class="fas fa-font prefix"></i>
        <input type="text" id="record-subject" name="record_subject" 
               class="form-control form-control-sm">
        <label for="record-subject">Subject</label>
    </div>

    <div class="md-form form-sm">
        <i class="fa fa-pencil-alt prefix"></i>
        <textarea type="text" id="record-remarks" name="record_remarks" 
                  class="md-textarea form-control"></textarea>
        <label for="infosys-desc">Remarks</label>
    </div>

    <div class="md-form form-sm">
        <i class="far fa-calendar-alt prefix"></i>
        <input type="date" id="record-date-due" name="record_date_due" 
               class="form-control form-control-sm">
        <label for="record-date-due">Due Date</label>
    </div>

    <input type="hidden" id="form-action" value="{{ url('records/store/' . $type) }}">
</form>