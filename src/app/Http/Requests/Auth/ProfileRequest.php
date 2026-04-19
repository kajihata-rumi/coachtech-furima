<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'regex:/^\d{3}-\d{4}$/'],
            'address' => ['required', 'string', 'max:255'],
            'building' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'ユーザー名を入力してください。',
            'name.max' => 'ユーザー名は255文字以内で入力してください。',

            'postal_code.required' => '郵便番号を入力してください。',
            'postal_code.regex' => '郵便番号は「123-4567」形式で入力してください。',

            'address.required' => '住所を入力してください。',
            'address.max' => '住所は255文字以内で入力してください。',

            'building.max' => '建物名は255文字以内で入力してください。',

            'image.image' => '画像ファイルを選択してください。',
            'image.mimes' => '画像はjpegまたはpng形式でアップロードしてください。',
            'image.max' => '画像サイズは2MB以下にしてください。',
            'image.uploaded' => 'プロフィール画像のアップロードに失敗しました。',
        ];
    }
}