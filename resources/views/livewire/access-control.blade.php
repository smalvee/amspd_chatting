<div>
    <x-breadcrumb title="{{ __('Access') }}"/>





    <div class="row g-3 mb-3">
        <div class="col-md-12">
            <div class="card">





                <div class="card-header">
                    <div id="tableExample3" data-list='{"valueNames":["id","m_name","action"],"page":10,"pagination":true}'>
                        <div class="row justify-content-end g-0">
                            <div class="col-auto col-sm-5 mb-3">
                                <form>
                                    <div class="input-group"><input class="form-control form-control-sm shadow-none search" type="search" placeholder="Search..." aria-label="search" />
                                        <div class="input-group-text bg-transparent"><span class="fa fa-search fs--1 text-600"></span></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive scrollbar">
                            <table class="table table-bordered table-striped fs--1 mb-0">
                                <thead class="bg-200 text-900">
                                    <tr>
                                        <th class="sort" data-sort="id">#</th>
                                        <th class="sort" data-sort="m_name">Module Name</th>
                                        <th class="sort" data-sort="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach($modules as $module)
                                    <tr>
                                        <td class="id">{{ $loop->iteration }}</td>
                                        <td class="m_name">{{$module->module_name}}</td>
                                        <td class="action">
                                            <a href="{{ route('provide_access', $module->id) }}" class="btn btn-falcon-primary btn-sm">Provide Access</a>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-3"><button class="btn btn-sm btn-falcon-default me-1" type="button" title="Previous" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
                            <ul class="pagination mb-0"></ul><button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next" data-list-pagination="next"><span class="fas fa-chevron-right"> </span></button>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

</div>



<script>
    window.addEventListener('closeModal', event => {
        console.log('Close modal event triggered');
        var button = document.getElementById("close_button");
        button.click();

    });
</script>