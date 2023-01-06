<?php

namespace App\Http\Livewire\Gerant\GestionArticle;

use App\Models\Residence;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ArticleAddComponent extends Component
{
    public $name;
    public $slug;
    public $residence_id;

    public function generateslug()
    {
        $this->slug = Str::slug($this->name);
    }
    public function addItem()
    {
        // dd('hiiii');
        $this->validate([
            'name'=>'required',
            'slug'=>'required|unique:residences,slug',

        ],[
            'name.required'=>'Entrer le Nom',
            'name.regex'=>'Pas de caractères spéciaux',

        ]);
        $item=new Article();
        $item->name=$this->name;
        $item->slug=$this->slug;
        $item->residence_id=$this->residence_id;
        $item->user_id=Auth::user()->id;


        if($item->save()){
            return redirect()->route('admin.article.list')->with('showsucces',['message'=>'Article a été ajouté avec Succès']);
            // $this->dispatchBrowserEvent;

        }else{
            $this->dispatchBrowserEvent('showerror',['message'=>'Erreur d\'ajouter un article']);
        }
    }
    public function render()
    {
        $data=[
            "residences"=>Residence::where('user_id',Auth::user()->id)->get(),
        ];
        return view('livewire.gerant.gestion-article.article-add-component',$data)->layout('layouts.gerant.main');
    }
}