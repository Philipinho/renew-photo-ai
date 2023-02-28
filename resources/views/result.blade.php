<x-app-layout>

    <section>


        <div class="max-w-6xl mx-auto px-4 sm:px-6">

            <div class="pt-32 pb-12 md:pt-40 md:pb-20" x-data="{preview: false}">


                <div class="w-full max-w-sm mx-auto px-4">
                    <div class="flex w-full border-4 border-gray-200 rounded-xl bg-gray-200 mb-12">
                        <button
                            class="transition rounded-lg w-full block py-1 text-sm"
                            :class="preview == false ? 'bg-white shadow-ios' : 'hover:text-gray-400'"
                            @click="preview = false"
                            type="button">Compare
                        </button>
                        <button
                            class="transition rounded-lg w-full block py-1 text-sm"
                            :class="preview == true ? 'bg-white shadow-ios' : 'hover:text-gray-400'"
                            @click="preview = true"
                            type="button">Side by side
                        </button>
                    </div>
                </div>

                <div class="flex justify-center sm:flex-row flex-col" :class="preview == true ? '' : 'hidden'">

                    <div class="mt-4 mx-3 relative">
                        <h3 class="text-xl font-semibold text-center">Original Image</h3>
                        <img src="{{ $result->input_image_url }}" class="rounded-2xl w-[475px]" loading="lazy">
                    </div>

                    <div class="mt-4 mx-1 relative">
                        <h3 class="text-xl font-semibold text-center">Restored Image</h3>
                        <img src="{{ $result->output_image_url }}" class="rounded-2xl w-[475px]" loading="lazy">
                    </div>

                </div>

                <div class="mt-5 text-center" :class="preview == true ? 'hidden' : ''">

                    <img-comparison-slider class="relative" tabindex="0">
                        <figure slot="first" class="rounded-2xl w-[475px]">
                            <img class="rounded-2xl w-[475px]" width="100%" src="{{ $result->input_image_url }}">
                            <figcaption class="absolute top-0 left-0 px-4 py-2 bg-white text-gray-800 rounded-tl-md">
                                <span>Before</span>
                            </figcaption>
                        </figure>
                        <figure slot="second" class="rounded-2xl w-[475px]">
                            <img class="rounded-2xl w-[475px]" width="100%" src="{{ $result->output_image_url }}">
                            <figcaption class="absolute top-0 right-0 px-4 py-2 bg-white text-gray-800 rounded-tr-md">
                                <span>After</span>
                            </figcaption>
                        </figure>
                    </img-comparison-slider>


                </div>

                <div class="mt-8 mx-auto text-center">

                    <x-primary-button class="bg-emerald-600 hover:bg-emerald-700 mb-4 md:mr-4 ">
                        <a href="{{ $result->output_image_url }}" class="text-xl">
                            Download Photo
                        </a>
                    </x-primary-button>

                    <x-primary-button class="bg-emerald-600 hover:bg-emerald-700 mb-4">
                        <a href="{{ route('process.show') }}" class="text-xl">
                            Try another image
                        </a>
                    </x-primary-button>
                </div>

                <div class="text-center py-2">
                    <button class="inline-flex items-center" onclick="copy()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="w-4 h-4 mr-1">
                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                        </svg>
                        <span>Copy link</span>
                    </button>
                </div>

            </div>
        </div>

    </section>

    <!--
    <div id="status">Process in progress...</div>
    -->

</x-app-layout>

<script>
    function copy() {
        const text = window.location.href;
        // Copy the text inside the text field
        try {
            navigator.clipboard.writeText(text);
            // Alert the copied text
        } catch (err) {
            console.error('Failed to copy: ', err);
        }
    }
</script>


@if(!($result->status == 'succeeded' || $result->status == 'failed'))
    <script>
        // Set a flag to track if polling should continue.
        let shouldPoll = true;

        const urlParams = new URLSearchParams(window.location.search);
        const uuid = urlParams.get('uuid');
        console.log(uuid);

        // Send a request to the /process-status route every 5 seconds.
        setInterval(function () {
            // Only send the request if polling should continue.
            if (shouldPoll) {
                axios.get(`/status?uuid=${uuid}`)
                    .then(function (response) {
                        // Update the status on the page.
                        document.getElementById('status').innerText = response.data.status;

                        // If the process has succeeded, stop polling and refresh the page.
                        if (response.data.status === 'succeeded') {
                            shouldPoll = false;
                            location.reload();
                        }
                    })
                    .catch(function (error) {
                        // If the status code is 404, stop polling.
                        if (error.response && error.response.status === 404) {
                            shouldPoll = false;
                        }

                        // Log any other errors to the console.
                        console.error(error);
                    });
            }
        }, 5000);
    </script>
@endif
