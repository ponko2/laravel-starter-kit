<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;

trait ConfirmRequestTrait
{
    /**
     * Set custom messages for validator errors.
     *
     * @param \Illuminate\Contracts\Validation\Factory $factory
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator($factory)
    {
        // 確認画面用フラグのバリデーションを追加
        $rules = array_merge($this->rules(), [
            'confirming' => 'required|accepted',
        ]);

        $validator = $factory->make(
            $this->all(),
            $rules,
            $this->messages(),
            $this->attributes()
        );

        $validator->after(function ($validator) {
            $failed = $validator->failed();

            // 確認画面用フラグのバリデーションを除外
            unset($failed['confirming']);

            // 確認画面用フラグ以外にエラーが無い場合は確認画面を表示
            if (count($failed) === 0) {
                $this->merge(['confirming' => 'true']);
            }
        });

        return $validator;
    }

    /**
     * Format the errors from the given Validator instance.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     *
     * @return array
     */
    protected function formatErrors(Validator $validator)
    {
        $errors = parent::formatErrors($validator);

        // 確認画面用フラグのエラーメッセージを削除
        unset($errors['confirming']);

        return $errors;
    }
}
