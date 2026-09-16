<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComplaintResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return[
            'id' => $this->id,
            'subject' => $this->subject,
            'description' => $this->description,
            'location' => $this->location,
            'status' => $this->status,
            'date_submitted' => $this->date_submitted,
            'date_resolved' => $this->date_resolved,

            'citizen' => [
                'id' => $this->citizen->id,
                'name' => $this->citizen->first_name. '' . $this->citizen->last_name,

            ],

            'category' => $this->category?->category_name,
            'priority' => $this->priority?->priority_name,
            'department' => $this->department?->department_name,

            'assigned_staff' => $this->assignedStaff ? [
                'id' => $this->assignedStaff->id,
                'name' => $this->assignedStaff->first_name . '' . $this->assigneStaff->last_name,

            ] : null,

            'attachments' => $this->attachments->pluck('file_path'),


        ];
    }
}
