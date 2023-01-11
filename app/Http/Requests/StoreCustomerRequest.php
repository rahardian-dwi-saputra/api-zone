<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        if(request()->routeIs('datacustomer.update')){
            return $this->user()->can('update', $this->datacustomer);
        }
        if(request()->routeIs('customers.update')){
            return $this->user()->can('update', $this->customer);
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        $rules = [
            'nama' => 'required|string|max:255',
            'nomor_telepon' => 'required|numeric|unique:customers,nomor_telepon',
            'email' => 'nullable|email|max:255|unique:customers,email',
            'provinsi_id' => 'required|exists:provinsi,id',
            'kota_id' => 'required|exists:kota,id',
            'kecamatan_id' => 'required|exists:kecamatan,id',
        ];

        if(request()->routeIs('datacustomer.update')){
            $rules['email'] = [
                'nullable',
                'email',
                'max:255',
                Rule::unique('customers', 'email')->ignore($this->datacustomer)
            ];
            $rules['nomor_telepon'] = [
                'required',
                'numeric',
                Rule::unique('customers', 'nomor_telepon')->ignore($this->datacustomer)
            ];
        }

        if(request()->routeIs('customers.update')){
            $rules['email'] = [
                'nullable',
                'email',
                'max:255',
                Rule::unique('customers', 'email')->ignore($this->customer)
            ];
            $rules['nomor_telepon'] = [
                'required',
                'numeric',
                Rule::unique('customers', 'nomor_telepon')->ignore($this->customer)
            ];
        }
        return $rules;
    }
    public function attributes(){
        return [
            'nama' => 'Nama Customer',
            'nomor_telepon' => 'Nomor Telepon',
            'provinsi_id' => 'Provinsi',
            'kota_id' => 'Kota',
            'kecamatan_id' => 'Kecamatan',
        ];
    }

    protected function prepareForValidation(){
        /*
        if($this->provinsi_id == null){
            $this->request()->remove('provinsi_id');
        }
        /*
        $this->merge([
            'slug' => Str::slug($this->slug),
        ]);
        */
    }
}
