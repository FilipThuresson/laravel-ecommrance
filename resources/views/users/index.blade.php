<x-app-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>
    <div>

        <div class="w-full flex justify-end">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Create new user</a>
        </div>

        <table class="table mt-2">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>First created</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <i class="iconoir-circle rounded-box {{ $user->isActive() ? 'text-success bg-success' : 'text-error bg-error' }}"></i>
                    </td>
                    <td>{{ $user->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
</x-app-layout>
