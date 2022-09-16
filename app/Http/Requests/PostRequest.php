<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'check' => 'required',
            'subject_id' => 'required',
            'text' => 'required',
            'file' => 'array|max:4',
            'file.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'text.required' => '投稿内容を記述してください。',
            'file.*.image' => '画像形式のファイルを選択してください。',
            'file.max' => '画像は4枚まで投稿可能です。',
        ];
    }
}
