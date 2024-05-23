<?php

namespace App\Livewire;

use App\Models\Type;
use App\Models\Website;
use Livewire\Component;

class SearchBox extends Component
{
    public $websites;

    public $allwebsites;

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
        $websites = $this->allwebsites;
        $websites = $websites->filter(function ($website) {
            return stripos($website->title, $this->search) !== false;
        });
        if ($this->selectedType) {
            $websites = $websites->filter(function ($website) {
                return $website->type_id == $this->selectedType;
            });
        }
        $this->websites = $websites;
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
        $this->allwebsites = $this->websites;
        $this->types = Type::all();
    }

    public function render()
    {
        return view('livewire.search-box');
    }
}
