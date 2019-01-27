<?php

namespace App\Http\Requests\Admincp;

use Illuminate\Foundation\Http\FormRequest;

class PortfolioRequest extends FormRequest
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
            //
            'name' => 'required',
            'client' => 'required',
            'link' => 'required',
            'smallpic' => 'mimes:jpeg,jpg,png',
            'fullpic' => 'mimes:jpeg,jpg,png',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'กรุณากรอกชื่อผลงาน',
            'client.required' => 'กรุณากรอกชื่อลูกค้า',
            'link.required' => 'กรุณากรอกลิงค์',
            'smallpic.required' => 'กรุณาเลือกภาพขนาดเล็ก',
            'fullpic.required' => 'กรุณาเลือกภาพขนาดใหญ่',
        ];
    }

}
