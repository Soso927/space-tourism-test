{{-- resources/views/vue/equipage.blade.php --}}
<x-layout>
    <x-slot:bgImage>
        {{ asset('images/background-destination.png') }}
    </x-slot:bgImage>
    <x-header />
    <main class="min-h-screen bg-[#0B0D17] text-white px-6 pt-20 lg:px-16 lg:pt-28">
        <div class="max-w-7xl mx-auto flex flex-col-reverse gap-10 lg:gap-16 lg:flex-row lg:items-center lg:justify-between">
            <!-- Colonne gauche : texte -->
            <section class="w-full lg:w-1/2 flex flex-col gap-8">
                <!-- En-tête -->
                <p class="uppercase tracking-widest text-sm text-blue-200">
                    <span class="opacity-50 mr-2">02</span>
                    Rencontrez l'équipage
                </p>
                <!-- Bloc texte -->
                <div class="text-center lg:text-left flex flex-col gap-4">
                    <p class="uppercase tracking-widest text-xs lg:text-sm text-blue-200">
                        {{ $member->{'role_' . app()->getLocale()} }}
                    </p>
                    <h1 class="text-4xl md:text-6xl font-serif uppercase">
                        {{ $member->{'name_' . app()->getLocale()} }}
                    </h1>
                    <p class="max-w-xl text-blue-100 leading-relaxed mx-auto lg:mx-0">
                        {{ $member->{'bio_' . app()->getLocale()} }}
                    </p>
                </div>
                <!-- Pagination dynamique -->
                <div class="flex justify-center lg:justify-start gap-4 mt-6">
                    @foreach($allMembers as $crew)
                        <a 
                            href="{{ route('equipage', $crew->slug) }}"
                            class="w-3 h-3 rounded-full transition {{ $crew->id === $member->id ? 'bg-white' : 'bg-white/30 hover:bg-white' }}"
                            title="{{ $crew->{'name_' . app()->getLocale()} }}"
                        ></a>
                    @endforeach
                </div>
            </section>
            <!-- Colonne droite : image -->
            <aside class="w-full lg:w-1/2 flex justify-center">
                <img
                    src="{{ asset('storage/' . $member->image) }}"
                    alt="Portrait de {{ $member->{'name_' . app()->getLocale()} }}"
                    class="w-full max-w-md lg:max-w-[480px] xl:max-w-[520px] h-auto object-contain"
                />
            </aside>
        </div>
    </main>
</x-layout>