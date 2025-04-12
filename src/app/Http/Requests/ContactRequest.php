<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'last-name' => ['required'],
            'first-name' => ['required'],
            'gender' => ['required'],
            'email' => ['required', 'email'],
            'tel-area' => ['required', 'numeric', 'digits_between:1,5'],
            'tel-city' => ['required', 'numeric', 'digits_between:1,5'],
            'tel-subscriber' => ['required', 'numeric', 'digits_between:1,5'],
            'address' => ['required'],
            'building' => [],
            'category_id' => ['required'],
            'detail' => ['required', 'max:120']
        ];
    }

    public function messages()
    {
        return [
            'last-name.required' => '姓を入力してください',
            'first-name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => '有効なメールアドレス形式を入力してください',
            'tel-area.required' => '電話番号を入力してください',
            'tel-area.numeric' => '電話番号は5桁までの数字で入力してください',
            'tel-area.digits_between' => '電話番号は5桁までの数字で入力してください',
            'tel-city.required' => '電話番号を入力してください',
            'tel-city.numeric' => '電話番号は5桁までの数字で入力してください',
            'tel-city.digits_between' => '電話番号は5桁までの数字で入力してください',
            'tel-subscriber.required' => '電話番号を入力してください',
            'tel-subscriber.numeric' => '電話番号は5桁までの数字で入力してください',
            'tel-subscriber.digits_between' => '電話番号は5桁までの数字で入力してください',
            'address.required' => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.max' => 'お問合せ内容は120文字以内で入力してください',
        ];
    }
}
