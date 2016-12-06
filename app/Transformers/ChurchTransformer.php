<?php
/**
 * Created by PhpStorm.
 * User: adamh
 * Date: 12/6/16
 * Time: 3:06 PM
 */

namespace App\Transformers;


use League\Fractal\TransformerAbstract;

class ChurchTransformer extends TransformerAbstract
{

    public function transform($church) {
        return [
            'id' => $church->id,
            'church' => $church->name,
            'address' => [
                'street_address' => $church->address,
                'secondary_address' => $church->address2,
                'city' => $church->city,
                'state' => $church->state,
                'zipcode' => $church->zipcode
            ]
        ];
    }


}