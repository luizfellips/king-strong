<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery.inputmask.min.js') }}"></script>
    <title>PowerMaromba</title>
    <style>
        .fade-in {
            opacity: 0;
            transition: opacity 0.5s ease-in;
        }

        .fade-in.show {
            opacity: 1;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            align-content: center;
        }

        .modal-content {
            background-color: white;
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 500px;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }
        /* HTML: <div class="loader"></div> */
        .loader {
            margin-block-start: 10px;
            width: 50px;
            aspect-ratio: 1;
            display: grid;
            color: #ffffff;
            background: radial-gradient(farthest-side, currentColor calc(100% - 6px), #0000 calc(100% - 5px) 0);
            -webkit-mask: radial-gradient(farthest-side, #0000 calc(100% - 13px), #000 calc(100% - 12px));
            border-radius: 50%;
            animation: l19 2s infinite linear;
        }

        .loader::before,
        .loader::after {
            content: "";
            grid-area: 1/1;
            background:
                linear-gradient(currentColor 0 0) center,
                linear-gradient(currentColor 0 0) center;
            background-size: 100% 10px, 10px 100%;
            background-repeat: no-repeat;
        }

        .loader::after {
            transform: rotate(45deg);
        }

        @keyframes l19 {
            100% {
                transform: rotate(1turn)
            }
        }
    </style>
</head>

<body>
    <div
        class="bg-gray-100 flex justify-center items-center {{ Request::route() && Request::route()->getName() !== 'onerepmax.process' ? 'h-screen' : '' }}">
        <div class="lg:p-36 md:p-52 sm:20 p-8 fade-in">
            <x-logo />
            <div class="isLoading h-screen fixed inset-0 hidden">
                <div class="flex justify-center bg-black items-center h-screen bg-opacity-50">
                    <div class="loader"></div>
                </div>
            </div>
            
            {{ $slot }}
        </div>
    </div>

</body>
<script src="{{ asset('js/requests.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.fade-in').addClass('show');
    });

    $(document).ready(function() {
        $('.openModal').click(function(event) {
            event.preventDefault();
            $('.isLoading').css('display', 'block');

            var id = $(this).attr('id');
            const url = 'http://127.0.0.1:8000/api/compounds/' + id;

            $.get(url)
                .done(response => {
                    processData(response.data);
                })
                .fail((xhr, status, error) => {
                    console.error(error);
                });
        });
    });

    function processData(data) {
        $('#name').text(data.name);
        $('#description').text(data.description);
        $('#shortDescription').text(data.shortDescription);

        // Clear previous content
        $('#muscles').empty();

        // Iterate over muscles array and create span elements
        data.muscles.forEach(function(muscle, index) {
            var span = $('<span>', {
                'class': 'bg-red-300 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900',
                'text': muscle
            });

            // Append the span to the container
            $('#muscles').append(span);

            if ((index + 1) % 1 === 0) {
                // Append a new row div after every 3 spans
                $('#muscles').append('<div class="row"></div>');
            }
        });
        let baseUrl = '{{ asset('') }}';
        $('#image').attr('src', baseUrl + data.imagePath);
        $('#compound_id').val(data.id);
        setTimeout(() => {
            $('.isLoading').hide();
            $('#myModal').fadeIn();
        }, 100);
    }
</script>

</html>
