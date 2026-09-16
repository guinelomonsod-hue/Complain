<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComplaintRequest;
use App\Http\Resources\ComplaintResource;
use Illuminate\Http\Request;
use App\Models\Complaint;


class ComplaintController extends Controller
{
    public function index (Request $request) {
        $user = auth('api')->user();
        $role = auth('api')->payload()->role();

        $query = Complaint::with([
            'citizen',
            'category',
            'department',
            'priority',
            'assignedStaff',
            'attachment',
        ]);

        if($role === 'citizen ') {
            $query->where('citizen_id', $user->citizen_id);
        }

        $complaints = $query->latest()->paginate(10);

        return ComplaintResource::collection($complaints);
    }

    public function store (Request $request) {
        $user = auth('api')->user();

        $complaint = Complaint::create([
            'category_id' => $request->category_id,
            'priority_id' =>$request->priority_id,
            'subject' =>$request->subject,
            'description' => $request->description,
            'location' => $request->location,
            'status' => $request->pending,
        ]);
        return new ComplaintResource(
            $complaint->load(['citizen', 'category' , 'priority'])
        );
    }
    public function show (Complaint $complaint){
        return new ComplaintResource(
            $complaint->load([
                'citizen', 
                'category', 
                'priority', 
                'department',
                'assignedStaff',
                'attachments' , 
                'updates'])
         );
    }
    public function update (Request $request, Complaint $complaint) {
        $request->validate([
            'status' => 'sometimes|in:pending,in_progress,resolved, not_for_lgu',
            'department' => 'sometimes|exists:departments,id',
            'assigned_staff_id' => 'sometimes|exists:staff,id',
        ]);

        $complaint->update($request->only([
            'status',
            'department_id',
            'assigned_staff_id'
        ]));

        return new ComplaintResource(
            $complaint->fresh([
                'citizen',
                'category',
                'priority',
                'department',
                'assignedStaff'
            ])
        );
    }
}
