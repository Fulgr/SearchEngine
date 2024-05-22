<?php

namespace App\Livewire;

use App\Models\Website;
use Livewire\Component;

class SearchBox extends Component
{
    public $websites;

    public $createWebsiteModal = false;

    public $message;

    public $url;

    public $name;

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
        ]);

        $this->message = '';
        $this->url = '';
        $this->name = '';
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
    }

    public function render()
    {
        return view('livewire.search-box');
    }
}
