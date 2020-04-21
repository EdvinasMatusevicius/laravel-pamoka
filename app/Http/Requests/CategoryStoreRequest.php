<?php

namespace App\Http\Requests;

use App\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Str;


class CategoryStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'title'=>'required|string|max:255|min:3',
            'active'=>'nullable|boolean'
        ];
    }
    public function getData(): array{
        return [
            'title'=>$this->getTitle(),
            'slug'=>$this->getSlug(),
            'active'=>$this->getActive(),
        ];
    }
    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();
        $validator->after(function(Validator $validator){
            if($this->slugExists()){
                $validator->errors()->add('slug','This slug already exists');
            }
        });
        return $validator;
    }
    public function getTitle():string{
        return $this->input('title');
    }
    protected function getSlug(){
        $slugUnprepared=$this->input('slug'); 
        if(empty($slugUnprepared)){
            $slugUnprepared=$this->getTitle();
        }
        return Str::slug(trim($slugUnprepared));
    }
        
    public function getActive():bool{
        return (bool)$this->input('active');
    }
    protected function slugExists():bool{
        return Category::query()
        ->where('slug','=',$this->getSlug())
        ->exists();
    }
}
