<?php
declare(strict_types=1);
namespace App\Http\Requests;

use App\Product;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ProductStoreRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'title'=>'required|string|max:255|min:3',
            'description'=>'required|string|min:10',
            'price'=>'required|numeric|min:0.01',
            'categories'=>[
                'sometimes',
                'array'
            ],
            'active'=>'nullable|boolean',
            'image'=>'nullable|array',
            'image.*'=>'nullable|image'
        ];
    }
    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();
        $validator->after(function(Validator $validator){
            if(
                ($this->isMethod('POST')||$this->isMethod('put'))&&
                $this->slugExists()
                ){
                $validator->errors()->add('slug','This slug already exists');
            }
        });
        return $validator;
    }

    public function getData(): array{
        return [
            'title'=>$this->getTitle(),
            'slug'=>$this->getSlug(),
            'description'=>$this->getDescription(),
            'price'=>$this->getPrice(),
            'active'=>$this->getActive(),
        ];
    }
    public function getTitle():string{
        return (string)$this->input('title');
    }
    protected function getSlug(){
        $slugUnprepared=$this->input('slug'); 
        if(empty($slugUnprepared)){
            $slugUnprepared=$this->getTitle();
        }
        return Str::slug(trim($slugUnprepared));
    }
    public function getDescription():string{
        return $this->input('description');

    }    
    public function getPrice():float{
        return (float)$this->input('price',001);

    }    
    public function getActive():bool{
        return (bool)$this->input('active');
    }
    public function getCategories(): array{
        return $this->input('categories',[]);
    }
    public function getSuppliers(): array{
        return $this->input('suppliers',[]);
    }
    public function getImages(): array{
        return $this->file('image',[]);
    }

    protected function slugExists():bool{
        return Product::query()
        ->where('slug','=',$this->getSlug())
        ->exists();
    }
}
