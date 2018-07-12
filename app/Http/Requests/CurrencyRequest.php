<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Contracts\CurrencyRequest as CurrencyRequestContract;

class CurrencyRequest extends FormRequest implements CurrencyRequestContract
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'short_name' => 'required|string|min:2|max:10',
            'logo_url' => 'required|url',
            'price' => 'required|numeric|min:0.00|max:999999.99'
        ];
    }

    public function getTitle(): ?string
    {
        return $this->get('title');
    }

    public function getShortName(): ?string
    {
        return $this->get('short_name');
    }

    public function getLogoUrl(): ?string
    {
        return $this->get('logo_url');
    }

    public function getPrice(): ?float
    {
        return (float) $this->get('price');
    }
}
