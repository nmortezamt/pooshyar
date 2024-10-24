<?php

namespace App\Http\Livewire\Home\Search;

use Illuminate\Support\Str;
use Livewire\Component;
use Modules\Blog\Models\blog;
use Modules\Product\Product\Models\product;

class Index extends Component
{
    public string $search ='';
    public array $results = [];
    public array $searchable = [];

    protected array $rules = [
        'search' => 'required|min:3'
    ];

    public function mount()
    {
        $this->searchable =[
            product::class => ['title','img'],
            blog::class => ['title','img']
        ];
    }

    public function updatedSearch()
    {
        $this->reset('results');
        $this->validateOnly('search');
        $this->getSearchResults();
    }

    public function resetForm()
    {
        $this->reset(['search', 'results']);
    }

    public function getSearchResults()
    {
        foreach($this->searchable as $model=>$columns){
            $model_key = Str::camel(class_basename($model));
            $query = (new $model())->query();
            foreach($columns as $column){
                $query->orWhere($column,'LIKE','%'.$this->search.'%');
            }
            foreach($columns as $field){
                $queryResult = $query->take(10)->get();
                if($queryResult->count()>0){
                    $this->results[$model_key] = $queryResult->map(function($item) use ($field){
                        $fields = [];
                        $field_key = Str::ucfirst($field);
                        $route_params=$item->id;
                        $img = $item->img;
                        $link = $item->link;
                        $title = $item->title;
                        $id = $item->id;
                        $fields[$field_key] = $item->{$field};

                        return [
                            'fields'=>$fields,
                            'id'=>$id,
                            'img'=>$img,
                            'link'=>$link,
                            'title'=>$title
                        ];


                    });
                }
            }

        }
    }


    public function render()
    {
        return view('livewire.home.search.index');
    }
}
