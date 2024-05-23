<div>
    @if($createWebsiteModal)
    <div class="modal">
        <div class="modal-content">
            <span class="close" wire:click="openCreateWebsiteModal">&times;</span>
            <h2>Add Website</h2>
            <form wire:submit.prevent="createWebsite">
                <label for="name">Name:</label>
                <input type="text" wire:model="name" id="name" />
                @error('name') <span class="error">{{ $message }}</span> @enderror
                <label for="url">URL:</label>
                <input type="text" wire:model="url" id="url" />
                @error('url') <span class="error">{{ $message }}</span> @enderror
                <label for="url">Description:</label>
                <input type="text" wire:model="message" id="message" />
                <span class="error">{{ $message }}</span>
                <label for="type">Type:</label>
                <select wire:model="type" id="type">
                    @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
                <button type="submit">Add</button>
            </form>
        </div>
    </div>
    @endif
    <div class="header">
        <div class="searchbar">
            <img src="images/searchicon.jpg" alt="logo" wire:click="searchFunc"/>
            <input type="text" wire:model="search" placeholder="Search..." wire:keydown="searchFunc"/>
        </div>
        <button wire:click="openCreateWebsiteModal">Add Website</button>
        <select wire:model="selectedType" wire:change="searchFunc">
            <option value="0">All types</option>
            @foreach($types as $type)
                <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="main">
        @foreach($websites as $website)
            <div class="website">
                <img src="{{$website->url}}/favicon.ico" id="backup-{{$website->id}}" onerror="standby({{$website->id}})">
                <div class="website-content">
                    <a href="{{$website->url}}">
                        <p class="website-url">{{ $website->url }}</p>
                        <h2>{{ $website->title }}</h2>
                        <p>{{ $website->description }}</p>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>