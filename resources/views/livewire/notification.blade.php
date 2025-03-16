<div class="w-56 py-4 px-2">
    <div class="flex items-center justify-between">
        <span>
            <h4 class="text-lg"> {{ $notification->title }}</h4>
            <p class="text-xs">{{ $notification->created_at }}</p>
        </span>
        <button wire:click="read">
            <i class="iconoir-check-square"></i>
        </button>
    </div>

    <div class="divider mt-0"></div>

    <div>
        <p class="textarea-md">{{ $notification->body }}</p>
    </div>
</div>
