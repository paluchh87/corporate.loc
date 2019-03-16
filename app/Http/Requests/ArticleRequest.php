<?php

namespace Corp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::user()->canDo('ADD_ARTICLES');
        //return false;
    }

    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        $validator->sometimes('alias', 'unique:articles|max:150', function ($input) {

            if ($this->route()->hasParameter('articles')) {
                $model = $this->route()->parameter('articles');

                return ($model->alias !== $input->alias) && !empty($input->alias);
            }

            return !empty($input->alias);
        });

        $validator->sometimes('img', 'required', function ($input) {

            if ($this->route()->hasParameter('articles')) {
                $model = $this->route()->parameter('articles');

                return (empty($model->img));
            }

            return empty($input->image);
        });

        return $validator;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'text' => 'required',
            'category_id' => 'required|integer',
            'keywords'=>'required|max:255',
            'meta_desc'=>'required|max:255',
        ];
    }
}
