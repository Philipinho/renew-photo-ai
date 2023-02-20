<div class="bg-white px-4 py-12">
    <div class="mx-auto max-w-lg">

        <form
            class="dropzone relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-12 text-center hover:border-emerald-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            action="{{ route('process.upload') }}" id="upload_area">
        </form>

    </div>

    <div id="image-container" class="mt-4 mx-auto max-w-lg">
        <img src="https://i.ibb.co/0QRwtd8/out.jpg"
             class="rounded-2xl w-[475px]">
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
            //dropzone.removeAllFiles();

            // Hide the form
           // document.querySelector('#upload_area').style.display = 'none';
            // redirect user to another page or use current page.


        });

    });

</script>
