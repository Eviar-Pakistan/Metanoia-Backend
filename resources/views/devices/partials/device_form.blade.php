<div class="card-body row">

<div class="form-group col-6">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $device->title ?? '') }}" required>
    @if ($errors->has('title'))
        <span class="text-danger">{{ $errors->first('title') }}</span>
    @endif
</div>
<div class="form-group col-6">
    <label for="group_id">Group ID</label>
    <input type="number" class="form-control" id="group_id" name="group_id" value="{{ old('group_id', $device->group_id ?? '') }}">
    @if ($errors->has('group_id'))
        <span class="text-danger">{{ $errors->first('group_id') }}</span>
    @endif
</div>
<div class="form-group col-6">
    <label for="type_id">Type ID</label>
    <input type="number" class="form-control" id="type_id" name="type_id" value="{{ old('type_id', $device->type_id ?? '') }}">
    @if ($errors->has('type_id'))
        <span class="text-danger">{{ $errors->first('type_id') }}</span>
    @endif
</div>
<div class="form-group col-6">
    <label for="tag_id">Tag ID</label>
    <input type="number" class="form-control" id="tag_id" name="tag_id" value="{{ old('tag_id', $device->tag_id ?? '') }}">
    @if ($errors->has('tag_id'))
        <span class="text-danger">{{ $errors->first('tag_id') }}</span>
    @endif
</div>
<div class="form-group col-6">
    <label for="status">Status</label>
    <input type="number" class="form-control" id="status" name="status" value="{{ old('status', $device->status ?? '') }}" required>
    @if ($errors->has('status'))
        <span class="text-danger">{{ $errors->first('status') }}</span>
    @endif
</div>
<div class="form-group col-6">
    <label for="android_version">Android Version</label>
    <input type="number" class="form-control" id="android_version" name="android_version" value="{{ old('android_version', $device->android_version ?? '') }}">
    @if ($errors->has('android_version'))
        <span class="text-danger">{{ $errors->first('android_version') }}</span>
    @endif
</div>
<div class="form-group col-6">
    <label for="client_app_version">Client App Version</label>
    <input type="text" class="form-control" id="client_app_version" name="client_app_version" value="{{ old('client_app_version', $device->client_app_version ?? '') }}">
    @if ($errors->has('client_app_version'))
        <span class="text-danger">{{ $errors->first('client_app_version') }}</span>
    @endif
</div>
<div class="form-group col-6">
    <label for="arborxr_home_version">ArborXR Home Version</label>
    <input type="text" class="form-control" id="arborxr_home_version" name="arborxr_home_version" value="{{ old('arborxr_home_version', $device->arborxr_home_version ?? '') }}">
    @if ($errors->has('arborxr_home_version'))
        <span class="text-danger">{{ $errors->first('arborxr_home_version') }}</span>
    @endif
</div>
<div class="form-group col-6">
    <label for="storage_used">Storage Used</label>
    <input type="text" class="form-control" id="storage_used" name="storage_used" value="{{ old('storage_used', $device->storage_used ?? '') }}">
    @if ($errors->has('storage_used'))
        <span class="text-danger">{{ $errors->first('storage_used') }}</span>
    @endif
</div>
<div class="form-group col-6">
    <label for="battery">Battery</label>
    <input type="text" class="form-control" id="battery" name="battery" value="{{ old('battery', $device->battery ?? '') }}">
    @if ($errors->has('battery'))
        <span class="text-danger">{{ $errors->first('battery') }}</span>
    @endif
</div>
<div class="form-group col-6">
    <label for="ssid">SSID</label>
    <input type="text" class="form-control" id="ssid" name="ssid" value="{{ old('ssid', $device->ssid ?? '') }}">
    @if ($errors->has('ssid'))
        <span class="text-danger">{{ $errors->first('ssid') }}</span>
    @endif
</div>
<div class="form-group col-6">
    <label for="signal_strength">Signal Strength</label>
    <input type="text" class="form-control" id="signal_strength" name="signal_strength" value="{{ old('signal_strength', $device->signal_strength ?? '') }}">
    @if ($errors->has('signal_strength'))
        <span class="text-danger">{{ $errors->first('signal_strength') }}</span>
    @endif
</div>
<div class="form-group col-6">
    <label for="frequency">Frequency</label>
    <input type="text" class="form-control" id="frequency" name="frequency" value="{{ old('frequency', $device->frequency ?? '') }}">
    @if ($errors->has('frequency'))
        <span class="text-danger">{{ $errors->first('frequency') }}</span>
    @endif
</div>
<div class="form-group col-6">
    <label for="link_speed">Link Speed</label>
    <input type="text" class="form-control" id="link_speed" name="link_speed" value="{{ old('link_speed', $device->link_speed ?? '') }}">
    @if ($errors->has('link_speed'))
        <span class="text-danger">{{ $errors->first('link_speed') }}</span>
    @endif
</div>
<div class="form-group col-6">
    <label for="ip_address">IP Address</label>
    <input type="text" class="form-control" id="ip_address" name="ip_address" value="{{ old('ip_address', $device->ip_address ?? '') }}">
    @if ($errors->has('ip_address'))
        <span class="text-danger">{{ $errors->first('ip_address') }}</span>
    @endif
</div>
<div class="form-group col-6">
    <label for="mac_address">MAC Address</label>
    <input type="text" class="form-control" id="mac_address" name="mac_address" value="{{ old('mac_address', $device->mac_address ?? '') }}">
    @if ($errors->has('mac_address'))
        <span class="text-danger">{{ $errors->first('mac_address') }}</span>
    @endif
</div>
<div class="form-group col-6">
    <label for="randomize_mac_address">Randomize MAC Address</label>
    <input type="text" class="form-control" id="randomize_mac_address" name="randomize_mac_address" value="{{ old('randomize_mac_address', $device->randomize_mac_address ?? '') }}">
    @if ($errors->has('randomize_mac_address'))
        <span class="text-danger">{{ $errors->first('randomize_mac_address') }}</span>
    @endif
</div>
<div class="form-group col-6">
    <label for="note">Note</label>
    <textarea class="form-control" id="note" name="note">{{ old('note', $device->note ?? '') }}</textarea>
    @if ($errors->has('note'))
        <span class="text-danger">{{ $errors->first('note') }}</span>
    @endif
</div>
</div>
