<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <link rel="apple-touch-icon" sizes="180x180" href="images/favicon_package/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="images/favicon_package/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="images/favicon_package/favicon-16x16.png">
        <link rel="manifest" href="images/favicon_package/site.webmanifest">
        <link rel="mask-icon" href="images/favicon_package/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
        <title>Gestore Excel: carica un file excel</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <div class="wrapper">
            <div class="container">
                <h1>Carica un file excel</h1>
                <div id="drop-area">
                    <form id='upload_form' class="my-form" method="POST" action="{{ url('handle_file') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="icons fa-4x">
                            <i class="fas fa-file-image" data-fa-transform="shrink-3 down-2 left-6 rotate--45"></i>
                            <i class="fas fa-file-alt" data-fa-transform="shrink-2 up-4"></i>
                            <i class="fas fa-file-pdf" data-fa-transform="shrink-3 down-2 right-6 rotate-45"></i>
                          </div>
                        <input type="file" name="uploaded_file" id="fileElem" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" onchange="uploadFile(this.file)">
                        <label class="button" for="fileElem">Fare clic per caricare&nbsp;</label>&nbsp;Oppure trascina e rilascia qui
                    </form>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <script src="{{ asset('/js/app.js') }}"></script>
    </body>
  </html>
