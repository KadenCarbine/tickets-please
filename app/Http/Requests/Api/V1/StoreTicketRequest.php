<?php

namespace App\Http\Requests\Api\V1;


use App\Http\Requests\Api\V1\BaseTicketRequest;
class StoreTicketRequest extends BaseTicketRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'data.attributes.title' => 'required|string',
            'data.attributes.description' => 'required|string',
            'data.attributes.status' => 'required|string|in:active,closed,hold,completed',

        ];
        if ($this->routeIs('tickets.store')) {
            $rules['data.relationships.author.data.id'] = 'required|integer';
        }
        return $rules;
    }

}
