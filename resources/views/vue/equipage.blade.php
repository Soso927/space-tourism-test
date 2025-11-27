<x-layout>
    <x-slot:bgImage>
        {{ asset('images/background-destination.png') }}
    </x-slot:bgImage>

    <x-header />

    <main class="min-h-screen bg-[#0B0D17] text-white px-6 pt-20 lg:px-16 lg:pt-28">

        <div class="max-w-7xl mx-auto flex flex-col-reverse gap-10 lg:gap-16 lg:flex-row lg:items-center lg:justify-between">

            <!-- COLONNE GAUCHE -->
            <section class="w-full lg:w-1/2 flex flex-col gap-8">

                <!-- En-tête -->
                <p class="uppercase tracking-widest text-sm text-blue-200">
                    <span class="opacity-50 mr-2">02</span>
                    {{ __('equipage.section_title') }}
                </p>

                <!-- Bloc texte -->
                <div id="crew-info" class="text-center lg:text-left flex flex-col gap-4">

                    @if(isset($current))
                        {{-- ROLE --}}
                        <p class="uppercase tracking-widest text-xs lg:text-sm text-blue-200">
                            {{ $current->{'role_' . app()->getLocale()} }}
                        </p>

                        {{-- NOM --}}
                        <h1 class="text-4xl md:text-6xl font-serif uppercase">
                            {{ $current->{'name_' . app()->getLocale()} }}
                        </h1>

                        {{-- BIO --}}
                        <p class="max-w-xl text-blue-100 leading-relaxed mx-auto lg:mx-0">
                            {{ $current->{'bio_' . app()->getLocale()} }}
                        </p>

                    @else
                        <p class="text-red-500">Aucun membre trouvé.</p>
                    @endif

                </div>

                <!-- PAGINATION (avec slugs) -->
                <div class="flex justify-center lg:justify-start gap-4 mt-6">

                    @foreach($crewMembers as $member)
                        <a href="{{ route('equipage', ['slug' => $member->slug]) }}"
                           class="w-3 h-3 rounded-full transition
                           {{ $member->id === $current->id
                                ? 'bg-white'
                                : 'bg-white/30 hover:bg-white' }}"
                           title="{{ $member->{'name_' . app()->getLocale()} }}">
                        </a>
                    @endforeach

                </div>

            </section>

            <!-- COLONNE DROITE - IMAGE -->
            <aside class="w-full lg:w-1/2 flex justify-center">

                @php
                    // Chemin image depuis storage/public
                    $imagePath = $current && $current->image
                        ? asset('storage/' . $current->image)
                        : asset('images/default-crew.png');
                @endphp

                <img
                    id="crew-image"
                    src="{{ $imagePath }}"
                    alt="{{ $current ? $current->{'name_' . app()->getLocale()} : '' }}"
                    class="w-full max-w-md lg:max-w-[480px] xl:max-w-[520px] h-auto object-contain"
                />
            </aside>

        </div>

    </main>

</x-layout>
