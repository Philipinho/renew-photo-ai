<x-app-layout>

    <!-- Hero -->
    <section class="relative">

        <!-- Illustration behind hero content -->
        <div class="absolute left-1/2 transform -translate-x-1/2 bottom-0 pointer-events-none -z-1" aria-hidden="true">
            <svg width="1360" height="578" viewBox="0 0 1360 578" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient x1="50%" y1="0%" x2="50%" y2="100%" id="illustration-01">
                        <stop stop-color="#FFF" offset="0%"/>
                        <stop stop-color="#EAEAEA" offset="77.402%"/>
                        <stop stop-color="#DFDFDF" offset="100%"/>
                    </linearGradient>
                </defs>
                <g fill="url(#illustration-01)" fill-rule="evenodd">
                    <circle cx="1232" cy="128" r="128"/>
                    <circle cx="155" cy="443" r="64"/>
                </g>
            </svg>
        </div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6">

            <!-- Hero content -->
            <div class="pt-32 pb-12 md:pt-40 md:pb-20">

                <!-- Section header -->
                <div class="text-center pb-12 md:pb-16">
                    <h1 class="text-5xl md:text-6xl font-bold leading-tighter tracking-tighter mb-4">
                        Restore your <span
                            class="bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-teal-400">photos with AI</span>
                    </h1>
                    <div class="max-w-3xl mx-auto">
                        <p class="text-xl mb-8" data-aos="zoom-y-out" data-aos-delay="150">
                            An AI photo restoration service uses machine learning to repair damaged or aged photos and
                            improve their quality, allowing individuals to preserve and cherish important memories for
                            years to come.

                        </p>
                        <div class="max-w-xs mx-auto sm:max-w-none sm:flex sm:justify-center" data-aos="zoom-y-out"
                             data-aos-delay="300">
                            <div>
                                <a class="btn text-white bg-blue-600 hover:bg-blue-700 w-full mb-4 sm:w-auto sm:mb-0"
                                   href="/process">Restore photo</a>
                            </div>
                            <div>
                                <a class="btn text-white bg-gray-900 hover:bg-gray-800 w-full sm:w-auto sm:ml-4"
                                   href="#0">Learn more</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <section id="faq">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="py-12 md:py-20 border-t border-gray-200">

                <!-- Section header -->
                <div class="max-w-3xl mx-auto text-center pb-2 md:pb-2">
                    <h2 class="text-xl mb-4">FAQ</h2>
                </div>

                <div class="">
                    <div class="mx-auto max-w-3xl px-6 py-5 sm:py-5 lg:py-5 lg:px-8">

                        <div class="mx-auto max-w-3xl divide-y divide-gray-900/10">
                            <h2 class="text-2xl font-bold leading-10 tracking-tight">Frequently asked
                                questions</h2>
                            <dl class="mt-4 space-y-6 divide-y divide-gray-900/10">
                                <div x-data="{ open: true }" class="pt-6">
                                    <dt>
                                        <button type="button" x-description="Expand/collapse question button"
                                                class="flex w-full items-start justify-between text-left"
                                                aria-controls="faq-0" @click="open = !open" aria-expanded="true"
                                                x-bind:aria-expanded="open.toString()">
                                            <span class="text-base font-semibold leading-7">What's the best thing about Switzerland?</span>
                                            <span class="ml-6 flex h-7 items-center">
                        <svg x-description="Icon when question is collapsed." x-state:on="Item expanded"
                             x-state:off="Item collapsed" class="h-6 w-6 hidden" :class="{ 'hidden': open }" fill="none"
                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"></path>
                        </svg>
                        <svg x-description="Icon when question is expanded." x-state:on="Item expanded"
                             x-state:off="Item collapsed" class="h-6 w-6" :class="{ 'hidden': !(open) }" fill="none"
                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6"></path>
                        </svg>
                     </span>
                                        </button>
                                    </dt>
                                    <dd class="mt-2 pr-12" id="faq-0" x-show="open">
                                        <p class="text-base leading-7">I don't know, but the flag is a big
                                            plus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas
                                            cupiditate laboriosam fugiat.</p>
                                    </dd>
                                </div>
                                <div x-data="{ open: false }" class="pt-6">
                                    <dt>
                                        <button type="button" x-description="Expand/collapse question button"
                                                class="flex w-full items-start justify-between text-left"
                                                aria-controls="faq-1" @click="open = !open" aria-expanded="false"
                                                x-bind:aria-expanded="open.toString()">
                                            <span
                                                class="text-base font-semibold leading-7">How do you make holy water?</span>
                                            <span class="ml-6 flex h-7 items-center">
                        <svg x-description="Icon when question is collapsed." x-state:on="Item expanded"
                             x-state:off="Item collapsed" class="h-6 w-6" :class="{ 'hidden': open }" fill="none"
                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"></path>
                        </svg>
                        <svg x-description="Icon when question is expanded." x-state:on="Item expanded"
                             x-state:off="Item collapsed" class="hidden h-6 w-6" :class="{ 'hidden': !(open) }"
                             fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                             aria-hidden="true">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6"></path>
                        </svg>
                     </span>
                                        </button>
                                    </dt>
                                    <dd class="mt-2 pr-12" id="faq-1" x-show="open" style="display: none;">
                                        <p class="text-base leading-7">You boil the hell out of it. Lorem
                                            ipsum dolor sit amet consectetur adipisicing elit. Magnam aut tempora vitae
                                            odio inventore fuga aliquam nostrum quod porro. Delectus quia facere id
                                            sequi expedita natus.</p>
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

</x-app-layout>
