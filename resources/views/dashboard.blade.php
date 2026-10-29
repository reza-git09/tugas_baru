<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold mb-4">Tes Event Broadcast (Order)</h3>

                    @if (session('success'))
                        <div class="mb-4 text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('orders.store') }}" method="POST" class="flex items-center gap-3">
                        @csrf
                        <input type="number" name="total" value="50000" class="border rounded px-3 py-2">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                            Buat Order
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>