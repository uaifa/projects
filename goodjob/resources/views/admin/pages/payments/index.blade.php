@push('title')
    Payments
@endpush

@push('css')
	<style type="text/css">
		html,
        body {
            height: 100%;
        }

        .d-flex {
            height: 100%;
        }

        #page-content-wrapper {
            display: flex;
            flex-direction: column;
        }

        #page-content-wrapper .container {
            flex-grow: 1;
        }
	</style>
@endpush
@include('admin.partials.head')

@include('admin.pages.payments.partials.main-content-section')


@push('js')
	<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
@endpush