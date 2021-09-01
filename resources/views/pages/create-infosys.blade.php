<form id="form-create" class="wow animated fadeIn p-3 m-0" 
      method="POST" enctype="multipart/form-data"
      action="{{ url('infosys/store') }}">
    {{ csrf_field() }}
    <div class="md-form form-sm mt-0">
        <div class="input-group">
            <div class="custom-file">
                <input class="custom-file-input" id="infosys-icon" name="infosys_icon" 
                       aria-describedby="infosys-icon" type="file"
                       accept="image/*">
                <label class="custom-file-label" for="infosys-icon">
                    <i class="fas fa-image"></i> Choose system icon file
                </label>
            </div>
        </div>
    </div>

    <div class="md-form form-sm">
        <select class="browser-default custom-select black-text"
                id="infosys-type" name="infosys_type"  
                style="font-size: 10.5pt;" required>
            <option value="" selected>------ Select system type ------</option>
            <option value="main">Main</option>
            <option value="special-project">Special Project</option>
            <option value="back-end">Back-end</option>
            <option value="others">Others</option>
        </select>
    </div>

    <div class="md-form form-sm">
        <i class="fas fa-window-maximize prefix"></i>
        <input type="text" id="infosys-name" name="infosys_name" 
               class="form-control form-control-sm" required>
        <label for="infosys-name">System Name</label>
    </div>

    <div class="md-form form-sm">
        <i class="fas fa-font prefix"></i>
        <input type="text" id="infosys-abrv" name="infosys_abrv" 
               class="form-control form-control-sm">
        <label for="infosys-abrv">Name Abbreviation (Optional)</label>
    </div>

    <div class="md-form form-sm">
        <i class="fa fa-pencil-alt prefix"></i>
        <textarea type="text" id="infosys-desc" name="infosys_desc" 
                  class="md-textarea form-control"></textarea>
        <label for="infosys-desc">Description</label>
    </div>

    <div class="md-form form-sm">
        <i class="fas fa-external-link-alt prefix"></i>
        <input type="text" id="infosys-local-url" name="infosys_local_url" 
               class="form-control form-control-sm">
        <label for="infosys-local-url">Local URL</label>
    </div>

    <div class="md-form form-sm">
        <i class="fas fa-external-link-alt prefix"></i>
        <input type="text" id="infosys-public-url" name="infosys_public_url" 
               class="form-control form-control-sm">
        <label for="infosys-public-url">Public URL</label>
    </div>

    <input type="hidden" id="form-action" value="{{ url('infosys/store') }}">
</form>