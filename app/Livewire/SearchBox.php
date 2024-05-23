<?php

namespace App\Livewire;

use App\Models\Type;
use App\Models\Website;
use Livewire\Component;

class SearchBox extends Component
{
    public $websites;

    public $createWebsiteModal = false;

    public $message;

    public $url;

    public $name;

    public $search;

    public $types;

    public $type = '1';

    public $selectedType;

    public function searchFunc()
    {
        ray($this->selectedType);
        $websites = Website::where('title', 'like', '%'.$this->search.'%');
        if ($this->selectedType) {
            $websites->where('type_id', $this->selectedType);
        }
        $this->websites = $websites->get();
    }

    public function createWebsite()
    {
        $this->validate([
            'url' => 'required|url',
            'name' => 'required',
        ]);

        Website::create([
            'url' => $this->url,
            'title' => $this->name,
            'description' => $this->message,
            'type_id' => $this->type,
        ]);

        $this->message = '';
        $this->url = '';
        $this->name = '';
        $this->type = '';
        $this->createWebsiteModal = false;
    }

    public function openCreateWebsiteModal()
    {
        if ($this->createWebsiteModal) {
            $this->createWebsiteModal = false;

            return;
        }
        $this->createWebsiteModal = true;
    }

    public function mount()
    {
        $this->websites = Website::all();
        $this->types = Type::all();
    }

    public function render()
    {
        return view('livewire.search-box');
    }
}
