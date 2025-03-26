<x-app-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>
    <div>

        <div class="w-full flex justify-end">
            <a href="{{ route('locations.create') }}" class="btn btn-primary">Add a location</a>
        </div>

        <table class="table mt-2">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Created</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($locations as $location)
                <tr>
                    <td>{{ $location->id }}</td>
                    <td>{{ $location->name }}</td>
                    <td>{{ $location->created_at }}</td>
                    <td class="flex justify-center gap-1 items-center text-lg">
                        @if($user->can('manage locations'))
                            <a href="{{ route('locations.edit', $location->id) }}" title="edit location"><i class="iconoir-edit-pencil"></i></a>
                        @endif
                        @if($user->can('manage locations'))
                            <a title="delete location" class="text-error" onclick="location_{{$location->id}}_delete.showModal()"><i class="iconoir-trash"></i></a>
                            <dialog id="location_{{$location->id}}_delete" class="modal">
                                <div class="modal-box">
                                    <h3 class="text-lg font-bold text-error">Deleting location</h3>
                                    <div class="divider"></div>
                                    <p class="py-4">You are about to delete location: {{$location->id}} ({{$location->name}})</p>
                                    <span class="flex justify-between items-center">
                                        <form action="{{ route('locations.destroy', $location->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-error">Delete</button>
                                        </form>
                                        <form method="dialog">
                                            <button class="btn btn-base-200 border-error border">Cancel</button>
                                        </form>
                                    </span>
                                </div>
                                <form method="dialog" class="modal-backdrop">
                                    <button>close</button>
                                </form>
                            </dialog>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $locations->links() }}
    </div>
</x-app-layout>
