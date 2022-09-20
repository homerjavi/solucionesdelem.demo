<x-app-layout>
    {{-- <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Servicios
            </h2>
        </div>
    </x-slot> --}}

    @if ( request()->routeIs( 'my-services' ) )
        <div class="flex justify-center pt-4">
            <x-button-link :href="route( 'services.create' )">
                Crear
            </x-button-link>
        </div>
    @endif    
    <div class="pt-4">
        <div class="flex flex-wrap gap-4 justify-evenly">
            @foreach ( $services as $service )
                <x-service-card :service="(object)$service"></x-service-card>
            @endforeach
        </div>
    </div>
</x-app-layout>
