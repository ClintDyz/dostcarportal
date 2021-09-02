<form id="form-edit" class="wow animated fadeIn p-3 m-0" 
      method="POST" enctype="multipart/form-data"
      action="{{ route('update-record-type', [
          'id' => $id
      ]) }}">
    {{ csrf_field() }}

    <div class="md-form form-sm">
        <i class="fas fa-keyboard prefix"></i>
        <input type="text" id="record-type" name="record_type" 
               class="form-control form-control-sm" value="{{ $type }}" required>
        <label for="record-type" class="{{ $type ? 'active' : '' }}">
            Type
        </label>
    </div>

    <div class="md-form form-sm">
        <i class="fas fa-grip-horizontal prefix"></i>
        <input type="text" id="record-type-icon" name="record_icon" 
               class="form-control form-control-sm" value="{{ $icon }}" required>
        <label for="record-type-icon" class="{{ $icon ? 'active' : '' }}">
            Icon
        </label>
    </div>

    <input type="hidden" id="form-action" value="{{ route('update-record-type', [
        'id' => $id
    ]) }}">
    <input type="hidden" id="delete-url" value="{{ route('delete-record-type', [
        'id' => $id
    ]) }}">
</form>