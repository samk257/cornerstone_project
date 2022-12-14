<?php

namespace App\Http\Livewire\Admin;

use App\Models\Items;
use App\Models\Residence;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;


class ItemAddComponent extends Component
{
    public $name;
    public $slug;
    public $residence_id;

    public function generateslug()
    {
        $this->slug = Str::slug($this->name);
    }
    public function mount()
    {

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
        $item=new Items();
        $item->name=$this->name;
        $item->slug=$this->slug;
        $item->residence_id=$this->residence_id;
        $item->user_id=Auth::user()->id;


        if($item->save()){
            return redirect()->route('item.list')->with('showsucces',['message'=>'Article a été ajouté avec Succès']);
            // $this->dispatchBrowserEvent;

        }else{
            $this->dispatchBrowserEvent('showerror',['message'=>'Erreur d\'ajouter un article']);
        }
    }

    public function render()
    {
        $userres=Auth::user();
        if(Auth::user()->roles="Admin"){
            $reside=Residence::all();
        }else{
            $reside=Residence::where('id',$userres)->first();
            $this->residence_id = $reside;

        }
        return view('livewire.admin.item-add-component',["reside"=>$reside])->layout('layouts.admin.main');
    }
}
