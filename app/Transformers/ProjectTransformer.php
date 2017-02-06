<?php

namespace App\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class ProjectTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [];

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [];

    /**
     * Transform object into a generic array
     *
     * @var $resource
     * @return array
     */
    public function transform($resource)
    {
        return [

            'id' => (int) $resource->id,
			'requester_id' => (int) $resource->requester_id,
			'event_contact_name' => $resource->event_contact_name,
			'event_contact_phone' => $resource->event_contact_phone,
			'address' => $resource->address,
			'secondary_address' => $resource->secondary_address,
			'city' => $resource->city,
			'state' => $resource->state,
			'zipcode' => $resource->zipcode,
			'phone' => $resource->phone,
			'directions' => $resource->directions,
			'parking' => $resource->parking,
			'description' => $resource->description,
			'day' => $resource->day,
			'time' => (int) $resource->time,
			'numVolunteers' => (int) $resource->numVolunteers,
			'family' => (bool) $resource->family,
			'howUsed' => $resource->howUsed,
			'skills' => $resource->skills,
			'materialsRequesterWill' => $resource->materialsRequesterWill,
			'materialsRequesterCannot' => $resource->materialsRequesterCannot,
			'materialsCityServe' => $resource->materialsCityServe,
			'evaluated' => (bool) $resource->evaluated,
			'approved' => (bool) $resource->approved,
			'assigned' => (bool) $resource->assigned,
			'evaluator_id' => (int) $resource->evaluator_id,
			'category_id' => (int) $resource->category_id,
			'volunteers_needed' => (int) $resource->volunteers_needed,
			'notes' => $resource->notes,
			'coordinator_id' => (int) $resource->coordinator_id,
			'confirmed' => (bool) $resource->confirmed,
			'short_description' => $resource->short_description,
			'created_at' => $resource->created_at,
			'updated_at' => $resource->updated_at,
        ];
    }
}
