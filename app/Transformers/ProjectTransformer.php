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
    protected $availableIncludes = ['project_category'];

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = ['project_category'];

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
			'requester_org_name' => $resource->requester_org_name,
            'requester_contact_name' => $resource->requester_contact_name,
            'requester_address' => $resource->requester_address,
            'requester_city' => $resource->requester_city,
            'requester_state' => $resource->requester_state,
            'requester_zipcode' => $resource->requester_zipcode,
            'requester_phone' => $resource->requester_phone,
            'requester_email' => $resource->requester_email,
            'requester_church' => $resource->requester_church,
			'event_contact_name' => $resource->event_contact_name,
			'event_contact_phone' => $resource->event_contact_phone,
			'event_address' => $resource->event_address,
			'event_secondary_address' => $resource->event_secondary_address,
			'event_city' => $resource->event_city,
			'event_state' => $resource->event_state,
			'event_zipcode' => $resource->event_zipcode,
			'event_phone' => $resource->event_phone,
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

            'volunteers' => $resource->volunteers_registered()
        ];
    }

    /**
     * Include Author
     *
     */
    public function includeProjectCategory($resource)
    {
        if ($cat = $resource->category) {
            return $this->item($cat, new ProjectCategoryTransformer());
        }
    }
}
