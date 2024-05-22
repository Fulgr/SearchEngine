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
                <button type="submit">Add</button>
            </form>
        </div>
    </div>
    @endif
    <div class="header">
        <div class="searchbar">
            <img src="images/searchicon.jpg" alt="logo" />
            <input type="text" wire:model="search" placeholder="Search...">
        </div>
        <button wire:click="openCreateWebsiteModal">Add Website</button>
    </div>
    <div class="main">
        @foreach($websites as $website)
            <div class="website">
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
