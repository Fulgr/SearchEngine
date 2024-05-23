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

    public $selectedWebsite;

    public $updateFavicon;

    public $updateType;

    public $editWebsiteModal;

    public function searchFunc()
    {
        $websites = $this->allwebsites;
        $websites = $websites->filter(function ($website) {
            return stripos($website->title.' '.$website->description, $this->search) !== false;
        });
        if ($this->selectedType) {
            $websites = $websites->filter(function ($website) {
                return $website->type_id == $this->selectedType;
            });
        }
        $this->websites = $websites->take(25);
    }

    public function delete($id)
    {
        $website = Website::find($id);
        if ($website) {
            $website->delete();
        }
        $this->editWebsiteModal = false;
        $this->selectedWebsite = '';
        $this->updateFavicon = '';
        $this->updateType = '';
        $this->allwebsites = Website::all()->sortByDesc('visits');
        $this->searchFunc();
    }

    public function updateWebsite()
    {
        $this->selectedWebsite->favicon = $this->updateFavicon;
        $this->selectedWebsite->type_id = $this->updateType;

        $this->selectedWebsite->save();
        $this->editWebsiteModal = false;
        $this->selectedWebsite = '';
        $this->updateFavicon = '';
        $this->updateType = '';
    }

    public function openEditModal($id)
    {
        if ($this->editWebsiteModal) {
            $this->editWebsiteModal = false;
            $this->selectedWebsite = '';
            $this->updateFavicon = '';
            $this->updateType = '';

            return;
        }
        $this->editWebsiteModal = true;
        $this->selectedWebsite = Website::find($id);
        $this->updateFavicon = $this->selectedWebsite->favicon;
        $this->updateType = $this->selectedWebsite->type_id;
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

    public function clickedWebsite($id)
    {
        $website = Website::find($id);
        if ($website) {
            $website->visits = $website->visits + 1;
            $website->save();
        }
    }

    public function mount()
    {
        $this->allwebsites = Website::all()->sortByDesc('visits');
        $this->websites = $this->allwebsites->take(25);
        $this->types = Type::all();
    }

    public function render()
    {
        return view('livewire.search-box');
    }
}
