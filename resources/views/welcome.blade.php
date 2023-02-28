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
                        <p class="text-xl text-gray-600 mb-8" data-aos="zoom-y-out" data-aos-delay="150">
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
                <div class="max-w-3xl mx-auto text-center pb-12 md:pb-16">
                    <h2 class="text-xl mb-4">FAQ</h2>
                    <p class="text-xl text-gray-600">
                        Answers to our top customer frequently asked questions.
                    </p>
                </div>


                <!-- Job list -->
                <div class="max-w-3xl mx-auto">

                    <h3 class="h4 mb-8">...</h3>

                    <div class="-my-3">

                        <!-- 1st Item -->
                        <a class="flex justify-between items-center p-4 rounded border border-gray-200 transition duration-300 ease-in-out bg-gray-100 shadow-md hover:bg-white hover:shadow-lg mb-3"
                           href="#0">
                            <div class="font-medium">FAQ 1</div>
                            <svg class="w-4 h-4 fill-current text-blue-600 shrink-0 ml-6" viewBox="0 0 16 16"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.707 1h-8v2h5.586L1 13.293l1.414 1.414L12.707 4.414V10h2V2a1 1 0 00-1-1z"/>
                            </svg>
                        </a>

                        <!-- 2nd Item -->
                        <a class="flex justify-between items-center p-4 rounded border border-gray-200 transition duration-300 ease-in-out bg-gray-100 shadow-md hover:bg-white hover:shadow-lg mb-3"
                           href="#0">
                            <div class="font-medium">FAQ 2</div>
                            <svg class="w-4 h-4 fill-current text-blue-600 shrink-0 ml-6" viewBox="0 0 16 16"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.707 1h-8v2h5.586L1 13.293l1.414 1.414L12.707 4.414V10h2V2a1 1 0 00-1-1z"/>
                            </svg>
                        </a>

                        <!-- 3rd Item -->
                        <a class="flex justify-between items-center p-4 rounded border border-gray-200 transition duration-300 ease-in-out bg-gray-100 shadow-md hover:bg-white hover:shadow-lg mb-3"
                           href="#0">
                            <div class="font-medium">FAQ 3</div>
                            <svg class="w-4 h-4 fill-current text-blue-600 shrink-0 ml-6" viewBox="0 0 16 16"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.707 1h-8v2h5.586L1 13.293l1.414 1.414L12.707 4.414V10h2V2a1 1 0 00-1-1z"/>
                            </svg>
                        </a>

                    </div>

                </div>

            </div>
        </div>
    </section>

</x-app-layout>
