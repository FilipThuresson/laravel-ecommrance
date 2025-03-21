<x-auth-layout>

    <div class="card bg-base-200 text-base-content text-2xl">
        <h1>{{ config('app.name') }}</h1>
    </div>

    <div class="card card-border border-base-300 bg-base-100 card-sm overflow-hidden">
        <form action="{{ route('login.store') }}" method="post">
            @csrf
            <div class="border-base-300 border-b border-dashed">
                <div class="flex items-center gap-2 p-4">
                    <div class="grow">
                        <div class="flex items-center gap-2 text-sm font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                 class="h-4 w-4 opacity-70">
                                <path
                                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z"></path>
                            </svg>
                            Login
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body gap-4">
                <div class="flex flex-col gap-1"><label class="input input-border flex max-w-none items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                             class="h-4 w-4 opacity-70">
                            <path
                                d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z"></path>
                        </svg>
                        <input type="text" name="email" class="grow" placeholder="email"></label></div>
                <div class="flex flex-col gap-1">
                    <label class="input input-border flex max-w-none items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                             class="h-4 w-4 opacity-70">
                            <path fill-rule="evenodd"
                                  d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        <input type="password" name="password" class="grow" placeholder="password">
                    </label>
                </div>
                @if($errors->any())
                    <span class="text-base-content/60 flex items-center gap-2 px-1 text-[0.6875rem] text-error">
                            <span class="status status-error inline-block"></span>
                            {{ $errors->first() }}
                    </span>
                @endif
                <label class="text-base-content/60 flex items-center gap-2 text-xs">
                    <input type="checkbox" class="checkbox" name="remember"> Remember me
                </label>
                <div class="card-actions items-center justify-center gap-6">
                    <button class="btn btn-accent">Login</button>
                </div>
            </div>
        </form>
    </div>

</x-auth-layout>
