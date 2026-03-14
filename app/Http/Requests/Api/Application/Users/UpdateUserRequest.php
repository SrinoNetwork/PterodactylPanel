<?php

namespace Pterodactyl\Http\Requests\Api\Application\Users;

use Pterodactyl\Models\User;

class UpdateUserRequest extends StoreUserRequest
{
    /**
     * Return the validation rules for this request.
     */
    public function rules(?array $rules = null): array
    {
        $rules = parent::rules($rules);
        $rules['access_all_servers'] = 'sometimes|boolean';
        
        return $rules;
    }
}
