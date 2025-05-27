<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class BaseTicketRequest extends FormRequest
{
    public function mappedAttributes()
    {
        $attributes = [
            'data.attributes.title' => 'title',
            'data.attributes.description' => 'description',
            'data.attributes.status' => 'status',
            'data.attributes.createdAt' => 'created_at',
            'data.attributes.updatedAt' => 'updated_at',
            'data.relationships.author.data.id' => 'user_id',
        ];

        $attributesToUpdate = [];

        foreach ($attributes as $key => $value) {
            if($this->has($key)) {
                $attributesToUpdate[$value] = $this->input($key);
            }
        }
        return $attributesToUpdate;
    }
    public function messages(): array
    {
        return [
            'data.attributes.status' => 'The ticket status must be active, completed, hold, or closed.',
        ];
    }
}
