<?php

namespace Corp\Http\Requests;

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
        return \Auth::user()->canDo('ADD_PORTFOLIOS');
        //return false;
    }

    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        $validator->sometimes('alias', 'unique:articles|max:150', function ($input) {

            if ($this->route()->hasParameter('portfolios')) {
                $model = $this->route()->parameter('portfolios');

                return ($model->alias !== $input->alias) && !empty($input->alias);
            }

            return !empty($input->alias);
        });

        $validator->sometimes('img', 'required', function ($input) {

            if ($this->route()->hasParameter('portfolios')) {
                $model = $this->route()->parameter('portfolios');

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
            'customer' => 'required|max:150',
            'filter_alias' => 'required|max:255',
            'keywords'=>'sometimes|max:255',
            'meta_desc'=>'sometimes|max:255'
        ];
    }
}
