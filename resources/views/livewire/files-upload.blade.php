<div>
    <div class="card">
        <div class="card-body">
            <div class="file-input-container">
                <input type="file" wire:model="files.{{ $field_name }}" @if($multiple) multiple @endif />
                <div class="file-input-text">Drag and drop your file here or click to browse</div>
            </div>
            <button class="btn btn-sm btn-success" wire:click="uploads">Upload All</button>
            @if ($files && $files[$field_name])
                @if($multiple)
                    <table class="table">
                        @foreach ($files[$field_name] as $key => $file)
                            <tr>
                                <td>
                                    <img src="{{ $file->temporaryUrl() }}" width="100">
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-danger"
                                        wire:click="remove({{ $key }}, '{{ $field_name }}')">Remove</button>
                                    <button class="btn btn-sm btn-success"
                                        wire:click="set({{ $key }}, '{{ $field_name }}')">Upload</button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @else
                <img src="{{ $files[$field_name]->temporaryUrl() }}" width="100">
                @endif
            @endif
        </div>
    </div>
</div>
