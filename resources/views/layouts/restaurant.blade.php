<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <meta charset="utf-8" />
        <title>{{ env('APP_NAME') }} | Restaurant Panel</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('public/backend/assets/images/favicon.png') }}">
        <!-- third party css -->
        <link href="{{ asset('public/backend/assets/css/vendor/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
        <!-- third party css end -->
        <!-- App css -->
        <link href="{{ asset('public/backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/backend/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{ asset('public/backend/assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />

        <link href="{{ asset('public/backend/assets/js/summernote/summernote-bs5.css') }}" rel="stylesheet" type="text/css" />
		<style>.tox-notification { display: none !important }
			.table-nowrap td, .table-nowrap th { white-space: normal!important; }
			.uppercase { text-transform: uppercase; }
			/*.simplebar-content-wrapper {background: linear-gradient(to right,rgba(255,255,255,.5),rgba(255,255,255,.5)),url({{ asset('public/backend/assets/images/test-back.png')}} ) no-repeat center bottom;*/
		</style>
	 	@yield('style')
    </head>

    <body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <!-- Begin page -->
        <div class="wrapper">
            <!-- ========== Left Sidebar Start ========== -->
            @include('Restaurant.include.sidebar')
            <!-- Left Sidebar End -->

            <div class="content-page">
                <div class="content">
                    <!-- Topbar Start -->
                    @include('Restaurant.include.header')
                    <!-- end Topbar -->
                    
                    <!-- Start Content-->
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                    <!-- container -->

                </div>
                <!-- content -->
            </div>

        </div>
        <script src="{{ asset('public/backend/assets/js/vendor.min.js') }}"></script>
        <script src="{{ asset('public/backend/assets/js/app.min.js') }}"></script>

        <!-- third party js -->
        <script src="https://cdn.tiny.cloud/1/3btezkyysy2sdjc1yauutxzauiuxe01fxn0dffdmbib5ldga/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>    
        <!-- third party js ends -->
        
        <!-- demo app -->
        <script src="{{ asset('public/backend/assets/js/pages/demo.dashboard.js') }}"></script>
        <!-- end demo js-->
        @yield('script')
        <script type="text/javascript">
        $(".inputnum").keydown(function(event) {
            if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 ) {
                //let it happen, don't do anything
            }
            else {
                if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                    event.preventDefault(); 
                }   
            }
        });
        $(document).ready(function() {
            $('input').attr("autocomplete", "off");
            $('textarea').attr("autocomplete", "off");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.maintitle').keyup(function(){
                $('.slugtitle').val(this.value.replace(/([~!#$^&*/()_+=`{}\[\]\'|\\:'<>,.|??? ])+/g, '-').replace(/@/g, '').replace(/%/g, '').toLowerCase());
            });
        });
		</script>
		<script type="text/javascript">
			$('.livecustomer').select2({
				placeholder: 'Select customer',
				ajax: {
					url: '{{route("customersearch")}}',
					dataType: 'json',
					delay: 250,
					processResults: function (data) {
						return {
							results: $.map(data, function (item) {
								return {
									text: item.name+' - '+item.mobile,
									id: item.id
								}
							})
						};
					},
					cache: true
				}
			});			
		</script>
		<script>
			var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
			tinymce.init({
				selector: 'textarea.summernote',
				imagetools_cors_hosts: ['picsum.photos'],
				menubar:false,
				statusbar: false,
				plugins: 'print preview paste importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons code',
				toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl code',
				toolbar_sticky: true,
				autosave_ask_before_unload: true,
				autosave_interval: '30s',
				autosave_prefix: '{path}{query}-{id}-',
				autosave_restore_when_empty: false,
				autosave_retention: '2m',
				image_advtab: true,
				init_instance_callback : function(editor) {
					var freeTiny = document.querySelector('.mce-notification');
					freeTiny.style.display = 'none';
				},
				link_list: [
					{ title: 'My page 1', value: 'https://www.tiny.cloud' },
					{ title: 'My page 2', value: 'http://www.moxiecode.com' }
				],
				image_list: [
					{ title: 'My page 1', value: 'https://www.tiny.cloud' },
					{ title: 'My page 2', value: 'http://www.moxiecode.com' }
				],
				image_class_list: [
					{ title: 'None', value: '' },
					{ title: 'Some class', value: 'class-name' }
				],
				importcss_append: true,
				file_picker_callback: function (callback, value, meta) {
					/* Provide file and text for the link dialog */
					if (meta.filetype === 'file') {
						callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
					}

					/* Provide image and alt text for the image dialog */
					if (meta.filetype === 'image') {
						callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
					}

					/* Provide alternative source and posted for the media dialog */
					if (meta.filetype === 'media') {
						callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
					}
				},
				templates: [
					{ title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
					{ title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
					{ title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
				],
				template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
				template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
				height: 200,
				image_caption: true,
				quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
				noneditable_noneditable_class: 'mceNonEditable',
				toolbar_mode: 'sliding',
				contextmenu: 'link image imagetools table',
				skin: useDarkMode ? 'oxide-dark' : 'oxide',
				content_css: useDarkMode ? 'dark' : 'default',
				content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
			});
		</script>
    </body>
</html>