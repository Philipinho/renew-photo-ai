<div>

    <div class="bg-white px-4 py-12">
        <div class="mx-auto max-w-lg">
            <form
                class="dropzone relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-12 text-center hover:border-emerald-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                action="{{ route('process.upload') }}" id="upload_area">
            </form>
        </div>

        <div class="flex justify-center sm:flex-row flex-col">

            <div class="mt-4 mx-3">
                <img src="https://i.ibb.co/0QRwtd8/out.jpg" class="rounded-2xl w-[475px]">
            </div>

            <div class="mt-4 mx-1">
                <img src="https://i.ibb.co/0QRwtd8/out.jpg" class="rounded-2xl w-[475px]">
            </div>

        </div>
    </div>

    <div wire:loading.delay>
        <div
            class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-700 opacity-75 flex flex-col items-center justify-center">
            <div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12 mb-4"></div>
            <h2 class="text-center text-white text-xl font-semibold">Restoring image...</h2>
            <p class="w-1/3 text-center text-white font-medium">This may take a few seconds, please don't close this
                page.</p>
        </div>
    </div>

</div>




<script>
    document.addEventListener('livewire:load', function () {
        let element_id = "#upload_area";

        let dropzone = new Dropzone(element_id, {
            url: '{{ route('process.upload') }}',
            //autoProcessQueue: true,
            paramName: 'file', // The name that will be used to transfer the file
            maxFileCount: 1,    // Max files
            maxFilesize: 2, //MB
            acceptedFiles: 'image/*', //acceptedFiles: ".jpeg,.jpg,.png,.gif"
            addRemoveLinks: true,
            dictDefaultMessage: "Drop your images here or click to browse",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            init: function () {
                this.on('error', function (file, errorMessage, xhr) {
                    //this.removeFile(file);
                    //console.log("why")

                    if (xhr) {
                        let errorResponse = JSON.parse(xhr.responseText);
                        this.emit('error', file, errorResponse.message);
                    } else {
                        // this.emit('error', file, errorMessage); causes a loop
                    }
                });

                this.on('success', function (file, response) {
                    console.log("Uploaded");
                    console.log(response);

                    Livewire.emit('handleImage', response.url);
                });
            }
        });

        Livewire.on('imageProcessed', function (data) {
            // Notes: Before we get this event, we have already removed all files from the dropzone
            // We should show a loading screen
            console.log("imageProcessed");
            console.log(data);
            dropzone.removeAllFiles();

            // Hide the form
            // document.querySelector('#upload_area').style.display = 'none';
            // redirect user to another page or use current page.

        });

    });

</script>

