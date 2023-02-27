<x-app-layout>

    <div class="bg-white px-4 py-12">
        <div class="flex justify-center sm:flex-row flex-col">

            <div class="mt-4 mx-3 relative">
                <h3 class="text-xl text-center">Input</h3>
                <img src="{{ $result->input_image_url }}" class="rounded-2xl w-[475px]" loading="lazy">
            </div>

            <div class="mt-4 mx-1 relative">
                <h3 class="text-xl text-center">Output</h3>
                <img src="{{ $result->output_image_url }}" class="rounded-2xl w-[475px]" loading="lazy">
            </div>

        </div>

        <div class="mt-5 mx-auto text-center">
            <x-primary-button class="bg-emerald-600 hover:bg-emerald-700 font-medium">
                <a href="{{ route('process.show') }}">
                    Try another image
                </a>
            </x-primary-button>
        </div>

    </div>

    <!--
    <div id="status">Process in progress...</div>
    -->

</x-app-layout>


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
