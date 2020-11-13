<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlatformRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    /**
     * The rule
     */
    private function rules() {
        $rules = [
            'game_plt' => 'nullable|max:255', 
        ];

        foreach($this->request->get('game_plt') as $key => $val) {
            $rules['game_plt.'.$key] = 'nullable|active_url|min:1|max:256';
        }

        return $rules;
    }
}
