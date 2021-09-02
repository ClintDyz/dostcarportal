<form id="form-create-record" class="wow animated fadeIn m-0" 
      method="POST" enctype="multipart/form-data"
      action="{{ url('records/store/' . $type) }}">
    {{ csrf_field() }}

    <div class="md-form form-sm">
        <i class="{{ $recordType->fa_icon }} prefix"></i>
        <input type="text" id="record-title" name="record_title" 
               class="form-control form-control-sm" required>
        <label for="record-title">
            {{ $recordType->type == 'Announcement' ? $recordType->type: 'Title' }}
        </label>
    </div>
</form>