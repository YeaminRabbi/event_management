<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('adminpanel/assets/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ config('app.name') }} @yield('page')</title>

    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo/favicon.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendor/css/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('adminpanel/assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('adminpanel/assets/css/custom-flash.css') }}" />


    <!-- Vendors CSS -->
    <link rel="stylesheet"
        href="{{ asset('adminpanel/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous">
    
    <!-- Page CSS -->
    @yield('css')

    {{-- @livewireStyles --}}

    <!-- Helpers -->
    <script src="{{ asset('adminpanel/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/js/config.js') }}"></script>
</head>

<body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            @include('adminpanel.layout.sidepanel')

            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('adminpanel.layout.navbar')
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    @yield('content')

                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div
                            class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                © {{ date('Y') }}, developed with <i style="color: red;">❤</i> by <a
                                    href="https://techstringit.com/" target="_blank"
                                    class="footer-link fw-bolder">Techstring IT</a>
                            </div>

                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->



    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('adminpanel/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('adminpanel/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('adminpanel/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('adminpanel/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('adminpanel/assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Axios cnd -->
    <script src="https://unpkg.com/axios/dist/axios.min.js" defer></script>

    <!-- CKEditor CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/decoupled-document/ckeditor.js"></script>

    <script>
        let editor;

        DecoupledEditor
            .create(document.querySelector('#editor'), {
                toolbar: {
                    items: [
                        'undo', 'redo',
                        '|', 'heading',
                        '|', 'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor',
                        '|', 'bold', 'italic', 'underline', 'strikethrough',
                        '|', 'alignment',
                        '|', 'numberedList', 'bulletedList',
                        '|', 'outdent', 'indent',
                        '|', 'link', 'blockQuote', 'insertTable', 'code',
                        '|', 'horizontalLine'
                    ],
                    shouldNotGroupWhenFull: true
                },
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        },
                        {
                            model: 'heading3',
                            view: 'h3',
                            title: 'Heading 3',
                            class: 'ck-heading_heading3'
                        }
                    ]
                },
                fontSize: {
                    options: ['small', 'default', 'big', 'huge']
                },
                table: {
                    contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                },
                placeholder: 'Start writing your blog post here...'
            })
            .then(newEditor => {
                editor = newEditor;

                // Store toolbar in dedicated container
                const toolbarContainer = document.querySelector('#toolbar-container');
                toolbarContainer.appendChild(editor.ui.view.toolbar.element);

                // Update hidden textarea when editor content changes
                editor.model.document.on('change:data', () => {
                    const editorContent = editor.getData();
                    document.querySelector('#editor-content').value = editorContent;

                    // Validate content length
                    if (editorContent.trim().length > 0) {
                        document.querySelector('#editor').classList.remove('invalid-editor');
                        document.querySelector('#description-error').style.display = 'none';
                    }
                });

                // Handle autosave
                setInterval(() => {
                    const content = editor.getData();
                    if (content.trim().length > 0) {
                        localStorage.setItem('editorContent', content);
                    }
                }, 30000); // Autosave every 30 seconds

                // Load autosaved content if exists
                const savedContent = localStorage.getItem('editorContent');
                if (savedContent && !editor.getData()) {
                    editor.setData(savedContent);
                }
            })
            .catch(error => {
                console.error(error);
            });

        // Custom form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const editorContent = editor.getData().trim();
            const editorElement = document.querySelector('#editor');
            const errorElement = document.querySelector('#description-error');

            if (editorContent.length === 0) {
                e.preventDefault();
                editorElement.classList.add('invalid-editor');
                errorElement.style.display = 'block';
                editorElement.scrollIntoView({
                    behavior: 'smooth'
                });
            } else {
                document.querySelector('#editor-content').value = editorContent;
                localStorage.removeItem('editorContent'); // Clear autosaved content
            }
        });
    </script>

    @yield('js')
    @stack('scripts')
    @livewireScripts
    <!-- Add Notyf CSS and JS -->

</body>

</html>
