<x-layout>
    <x-slot:bgImage>
        {{ asset('images/background-technology.png') }}
    </x-slot:bgImage>

    <x-header />

    <main class="min-h-screen bg-[#0B0D17] text-white px-6 pt-20 lg:px-16 lg:pt-28">
        <div class="max-w-7xl mx-auto flex flex-col gap-10 lg:gap-16 lg:flex-row lg:items-center lg:justify-between">

            <!-- Colonne gauche : numéros + texte -->
            <section class="w-full lg:w-1/2 flex flex-col gap-8">

                <!-- En-tête -->
                <p class="uppercase tracking-widest text-sm text-blue-200">
                    <span class="opacity-50 mr-2">03</span>
                    Space Launch 101
                </p>

                <!-- Pagination numérotée -->
                <div class="flex justify-center lg:justify-start gap-4">
                    @foreach($allTechnologies as $index => $tech)
                        <a href="{{ route('technologie', $tech->slug) }}"
                           class="w-10 h-10 rounded-full border flex items-center justify-center transition
                                  {{ $tech->id === $technology->id 
                                     ? 'bg-white text-black border-white' 
                                     : 'border-white/30 text-white hover:border-white' }}"
                           title="{{ $tech->{'name_' . app()->getLocale()} }}">
                            {{ $index + 1 }}
                        </a>
                    @endforeach
                </div>

                <!-- Bloc texte -->
                <div class="text-center lg:text-left flex flex-col gap-4">
                    <p class="uppercase tracking-widest text-xs lg:text-sm text-blue-200">
                        The terminology...
                    </p>

                    <h1 class="text-4xl md:text-6xl font-serif uppercase">
                        {{ $technology->{'name_' . app()->getLocale()} }}
                    </h1>

                    <p class="max-w-xl text-blue-100 leading-relaxed mx-auto lg:mx-0">
                        {{ $technology->{'description_' . app()->getLocale()} }}
                    </p>
                </div>
            </section>

            <!-- Colonne droite : image -->
            <aside class="w-full lg:w-1/2 flex justify-center">
                <img
                    src="{{ asset('storage/' . $technology->image) }}"
                    alt="{{ $technology->{'name_' . app()->getLocale()} }}"
                    class="w-full max-w-md lg:max-w-[480px] xl:max-w-[520px] h-auto object-contain"
                />
            </aside>

        </div>
    </main>
</x-layout>