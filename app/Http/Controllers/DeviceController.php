<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DeviceController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Devices List';

        if ($request->ajax()) {
            $data = Device::query();

            return DataTables::of($data)
                ->addColumn('status_display', function ($row) {
                    if ($row->status == 1) {
                        return '<span class="badge bg-success">Connected <i class="bi bi-wifi"></i></span>';
                    } else {
                        return '<span class="badge bg-danger">Disconnected <i class="bi bi-wifi-off"></i></span>';
                    }
                })
                ->addColumn('username', function ($row) {
                    $user =  User::find($row->user_id);
                    return ($user->first_name ?? '') .' '.($user->last_name ?? '');
                })
                ->addColumn('action', function ($row) {
                    $Button = '<div class="d-flex align-items-center list-action">';
                    $Button .= '<a href="' .  route('devices.show', ['device' => $row->id]) . '" class="badge bg-info mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class="ri-eye-line mr-0"></i></a>';
                    // $Button .= '<a href="' .  route('devices.edit', ['device' => $row->id]) . '" class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="ri-pencil-line mr-0"></i></a>';
                    $Button .= '<button class="badge badge-warning mr-2 delete-device border-0" data-id="' . $row->id . '" data-model="device" data-toggle="modal" data-target="#deleteDeviceModal"><i class="ri-delete-bin-line mr-0"></i></button>';
                    $Button .= '</div>';
                    return $Button;
                })
                ->rawColumns(['status_display', 'action'])
                ->make(true);
        }

        return view('devices.index', compact('title'));
    }

    public function create()
    {
        $title = "Create Device";
        return view('devices.create', compact('title'));
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|integer',
            'ip_address' => 'nullable|string|max:255',
            'mac_address' => 'nullable|string|max:255',
            'user_id' => 'required',
        ]);

        Device::create($request->all());

        return redirect()->route('devices.index')->with('success', 'Device created successfully.');
    }

    // Display the specified resource.
    public function show(Device $device)
    {
        return view('devices.show', compact('device'));
    }

    // Show the form for editing the specified resource.
    public function edit(Device $device)
    {
        $title = "Create Device";
        return view('devices.edit', compact('device','title'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, Device $device)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'group_id' => 'nullable|integer',
            'type_id' => 'nullable|integer',
            'tag_id' => 'nullable|integer',
            'status' => 'required|integer',
            'android_version' => 'nullable|integer',
            'client_app_version' => 'nullable|string|max:255',
            'arborxr_home_version' => 'nullable|string|max:255',
            'storage_used' => 'nullable|string|max:255',
            'battery' => 'nullable|string|max:255',
            'ssid' => 'nullable|string|max:255',
            'signal_strength' => 'nullable|string|max:255',
            'frequency' => 'nullable|string|max:255',
            'link_speed' => 'nullable|string|max:255',
            'ip_address' => 'nullable|string|max:255',
            'mac_address' => 'nullable|string|max:255',
            'randomize_mac_address' => 'nullable|string|max:255',
            'note' => 'nullable|string',
        ]);

        $device->update($request->all());

        return redirect()->route('devices.index')->with('success', 'Device updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy(Device $device)
    {
        $device->delete();

        return redirect()->route('devices.index')->with('success', 'Device deleted successfully.');
    }
}
