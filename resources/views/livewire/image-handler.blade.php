<div>

    <div class="pt-32 pb-12 md:pt-40 md:pb-20">

        <div class="max-w-3xl mx-auto text-center pb-12 md:pb-16">
            <h1 class="text-3xl font-semibold mb-4">Restore photo</h1>
            <p class="text-xl text-gray-600">
                 Select your prefered image to restore and see the magic of AI.
            </p>
        </div>


        <div class="mx-auto max-w-lg">
            <form
                class="dropzone relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-12 text-center hover:border-emerald-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                action="{{ route('process.upload') }}" id="upload_area">
            </form>
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

                    Livewire.emit('handleImage', response.image_url);
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

