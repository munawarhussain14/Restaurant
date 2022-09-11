@push("styles")
    @once
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    @endonce
@endpush
@push("scripts")
    @once
    <script src="{{asset('assets/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

    <script type="text/javascript">

    var table = $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route($params['route'].'.index') }}",
            columns: 
            [
            @foreach($params["columns"] as $values)
                {{"{"}}
                @foreach($values as $key=>$value)
                {{"$key:`$values[$key]`,"}}
                @endforeach
                {{"},"}}
            @endforeach
            ]
        });

        const onRemove = (id)=>{
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        jQuery.ajax({
          url: "{{ url($params['basic'])}}/"+id,
          method: 'delete',
          success: function(result){
              Swal.fire(
                'Deleted!',
                'Your entery has been deleted.',
                'success'
              );
              table.ajax.reload();
          }});
      }
    });
  }
    </script>
    @endonce
@endpush

<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{$params['plural_title']}}</h3>
        @if(isset($params["module_name"]))
            @can("create-".$params["module_name"])
            <div class="card-header-actions">
                <a href="{{route($params['route'].".create")}}" class="card-header-action"><i class="fa fa-plus"></i> Create {{$params['singular_title']}}</a>
            </div>
            @endcan
        @endif
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    <table id="data-table" class="table table-bordered table-hover">
        <thead>
        <tr>
        @foreach($params["columns"] as $values)
            <th {{($values["name"]=="ID")?"width=auto":(($values["name"]=="Action"||$values["name"]=="Status")?"width=18%":"")}}>{{$values["name"]}}</th>
        @endforeach
        </tr>
        </thead>
        <tbody></tbody>
    </table>
    </div>
    <!-- /.card-body -->
</div>