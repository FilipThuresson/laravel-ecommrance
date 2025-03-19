<div class="indicator">
    @if ($user->hasUnreadNotifications())
        <span class="indicator-item status status-accent"></span>
    @endif
    <div class="dropdown dropdown-bottom dropdown-end">
        <div tabindex="0" role="button"  class="btn btn-base border border-base-300 text-base-content text-xl">
            <i class="iconoir-bell"></i>
        </div>
        <div tabindex="0" class="dropdown-content bg-base-200 rounded-box z-1 p-2 shadow-sm mt-2">

            @if($notifications->isEmpty())
                <div class="w-56 py-4 px-2 text-center text-md">No unread notifications</div>
            @endif
            @foreach($notifications as $notification)
                <livewire:notification :notification="$notification"/>
            @endforeach
        </div>
    </div>
</div>
