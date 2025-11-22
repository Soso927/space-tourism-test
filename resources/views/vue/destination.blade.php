<x-layout>
    <!-- Image de fond -->
    <x-slot:bgImage>
        {{ asset('images/background-destination.png') }}
    </x-slot:bgImage>

    <x-header />

    <main class="min-h-screen text-white px-4 sm:px-6 md:px-8 lg:px-12 pt-16 sm:pt-20 text-center lg:text-left">

        <!-- Titre de section ("01 • CHOISISSEZ VOTRE DESTINATION") -->
        <p class="uppercase tracking-[0.3em] text-xs sm:text-sm md:text-base text-blue-200 mb-4 lg:mb-8 lg:mt-10">
            <span class="opacity-50 mr-3">{{ __('destinations.section_number') }}</span>
            {{ __('destinations.section_title') }}
        </p>

        <div class="flex flex-col lg:flex-row lg:justify-center gap-x-20">

            <!-- IMAGE DE LA PLANÈTE -->
            <img
                src="{{ $planet?->image ? asset('storage/' . $planet->image) : asset('images/default-planet.png') }}"
                alt="{{ app()->getLocale() === 'fr' ? $planet->name_fr : $planet->name_en }}"
                class="w-auto sm:w-56 md:w-72 lg:w-[500px] xl:w-[580px] h-auto mb-6 sm:mb-8 lg:mb-0" />
            <!-- COLONNE TEXTE -->
            <div class="flex flex-col lg:flex-col">

                <!-- ONGLET : MENU DES PLANÈTES -->
                <nav
                    class="flex flex-wrap justify-center lg:justify-start gap-6 uppercase tracking-[0.2em] mb-4 sm:mb-6 border-b border-[#383B4B]/80 pb-3">

                    @foreach ($planets as $p)
                    @php
                    // Détermine le slug selon la langue
                    $slug = app()->getLocale() === 'en' ? $p->slug_en : $p->slug_fr;

                    // Détermine le label FR/EN pour l'affichage
                    $label = app()->getLocale() === 'en' ? $p->name_en : $p->name_fr;

                    // Détermine si l'onglet correspond à la planète active
                    $isActive = $planet->id === $p->id;
                    @endphp

                    <a href="{{ route('destination.show', $slug) }}"
                        class="pb-2 uppercase tracking-[0.2em]
                            {{ $isActive ? 'text-white border-b-2 border-white' : 'text-blue-200 hover:text-white' }}">
                        {{ $label }}
                    </a>
                    @endforeach

                </nav>

                <!-- NOM DE LA PLANÈTE (alias 'name') -->
                <h1 class="font-serif uppercase text-5xl sm:text-6xl md:text-7xl lg:text-[92px] leading-none mb-4">
                    {{ $planet->name }}
                </h1>

                <!-- DESCRIPTION (alias 'description') -->
                <p class="max-w-md lg:max-w-xl mx-auto lg:mx-0 text-blue-100/90 leading-relaxed text-sm sm:text-base md:text-lg mb-8">
                    {{ $planet->description }}
                </p>

                <!-- Séparateur -->
                <div class="border-t border-[#383B4B]/80 mb-6 w-full max-w-md lg:max-w-xl mx-auto lg:mx-0"></div>

                <!-- INFORMATIONS : Distance + Durée -->
                <div
                    class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-8 uppercase tracking-[0.18em] text-blue-200 text-xs sm:text-sm md:text-base">

                    <!-- Distance -->
                    <div class="text-center lg:text-left">
                        <p class="mb-2">{{ __('destinations.distance_label') }}</p>
                        <p class="font-serif text-2xl sm:text-3xl md:text-4xl text-white tracking-normal">
                            {{ $planet->distance }}
                        </p>
                    </div>

                    <!-- Durée -->
                    <div class="text-center lg:text-left">
                        <p class="mb-2">{{ __('destinations.duration_label') }}</p>
                        <p class="font-serif text-2xl sm:text-3xl md:text-4xl text-white tracking-normal">
                            {{ $planet->duration }}
                        </p>
                    </div>

                </div>

            </div>

        </div>
    </main>
</x-layout>