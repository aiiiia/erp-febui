<x-wrapper-detail-project step="1">
    @push('css')
        <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    @endpush
    
    <div class="card" style="min-height: 400px;">
        <div class="card-body">
            <x-under-development></x-under-development>
        </div>   
    </div>

    @push('js')
        <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <script >
            $('table').DataTable({
                pageLength: 5,
                filter: true,
                "searching": true
            });
        </script>
    @endpush
</x-wrapper-detail-project>