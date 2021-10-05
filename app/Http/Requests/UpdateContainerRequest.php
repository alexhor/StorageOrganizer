<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use BenSampo\Enum\Rules\EnumValue;

class UpdateContainerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;

        /*
        //Route::post('/comment/{comment}');
        $comment = Comment::find($this->route('comment'));
        return $comment && $this->user()->can('update', $comment);


        // "route model binding" => return $this->user()->can('update', $this->comment);
        */
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'title' => 'required|string',
          'rfidTag' => 'nullable|alpha_num',
          'weight' => 'nullable|numeric',
          'description' => 'nullable|string',
          'contents' => 'required|string', // TODO: excape html content => https://laravel.com/docs/8.x/validation#preparing-input-for-validation
          'location' => 'nullable', // TODO: check if this really is a location
          'status' => ['required', new EnumValue(\App\Enums\ContainerStatus::class, false)],
        ];
    }
}
