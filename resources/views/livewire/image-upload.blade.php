<!--<div x-data="{ showSlider: false }" class="mt-10">
    <div class="mt-4 text-center">
        <button @click="showSlider = !showSlider"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded">Toggle Slider
        </button>
    </div>

    <div x-show="showSlider" class="w-full h-64 lg:h-96 flex justify-center items-center">

        <img-comparison-slider>
            <img class="object-contain w-60" slot="first" src="https://i.ibb.co/0QRwtd8/out.jpg" />
            <img class="object-contain w-60" slot="second" src="https://i.ibb.co/0QRwtd8/out.jpg" />
        </img-comparison-slider>

    </div>

</div>


-->
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
            autoProcessQueue: false,
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
                    if (xhr) {
                        let errorResponse = JSON.parse(xhr.responseText);
                        this.emit('error', file, errorResponse.message);
                    } else {
                        this.emit('error', file, errorMessage);
                    }
                });
                this.on('success', function (file, response) {
                    console.log("Uploaded");
                    console.log(response);
                    console.log(response.url);
                    Livewire.emit('imageUploaded', response.url);
                });
            }
        });

        dropzone.on('success', function (file, response) {
            console.log("cool");
            console.log(response);
        });


        Livewire.on('imageRenewed', function (url) {
            console.log("imageRenewed");
            console.log(url);
            dropzone.removeAllFiles();

            // Hide the form
            document.querySelector('#upload_area').style.display = 'none';

            // Create an image element with the uploaded image URL
            let img = document.createElement('img');
            img.src = url;
            img.classList.add('w-64', 'h-64', 'object-contain', 'mx-auto');

            // Add the image element to the page
            let imgContainer = document.querySelector('#image-container');
            imgContainer.appendChild(img);
        });


    });

</script>


{{--
<script>

    dropzone.on('dragenter', e => {
        e.preventDefault();
        console.log('dragenter');
        element.classList.add('bg-emerald-200');
    });

    dropzone.on('dragleave', () => {
        element.classList.remove('bg-emerald-200');
    });
    })
    ;
</script>
--}}

