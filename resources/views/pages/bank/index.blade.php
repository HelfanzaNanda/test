@extends('templates.default')

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Bank</h1>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
              <div class="card-header">
                <a href="{{ route('bank.create') }}" class="btn btn-sm btn-info">Tambah</a>
              </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th>Nama Bank</th>
                      <th>Logo</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($datas as $data)
                          <tr>
                              <td class="text-center">{{ $loop->iteration }}</td>
                              <td>{{ $data->bank_name }}</td>
                              <td><img src="{{ $data->logo }}" id="myImg" width="100" height="auto"></td>
                              <td>{{ $data->contact_email }}</td>
                              <td>
                                  <a href="{{ route('bank.edit', $data->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                                  <a href="#" class="btn btn-danger btn-sm" id="delete" data-id={{ $data->id }}>
                                  <i class="fa fa-remove"></i>
                                  </a>
                              </td>
                          </tr>

                          <div id="myModal" class="modal">
                            <span class="close">&times;</span>
                            <img class="modal-content" id="img01">
                            <div id="caption"></div>
                          </div>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('script')
  <script>
    const modals = document.querySelectorAll('#myModal');
    const imgs = document.querySelectorAll('#myImg');
    const modalImages = document.querySelectorAll('#img01');
    const spans = document.querySelectorAll('.close');

    imgs.forEach((img, i) => {
        img.addEventListener('click', function() {
            modals[i].style.display = "block";
            modalImages[i].src = this.src;
        });

        spans[i].addEventListener('click', function() {
            modals[i].style.display = "none";
        });
    }); 
  </script>
  

  <script>
    const dele = document.querySelectorAll('#delete');
    dele.forEach((del, i) => {
      const id = del.dataset.id;
        del.addEventListener('click', function () {
            Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: "Anda tidak akan dapat mengembalikan ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                })
                .then((result) => {
                    if (result.value) {
                      deleteData(id);
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire(
                            'Cancelled',
                            'Your imaginary file is safe :)',
                            'error'
                        )
                    }
                })
        });
    });

    const token = "{{ csrf_token() }}";
    const url = '{{ config('app.url') }}';
    function deleteData(id) {
      fetch(url + 'bank/' + id + '/destroy', {
          headers: {
              "Content-Type": "application/json",
              "Accept": "application/json, text-plain, */*",
              "X-Requested-With": "XMLHttpRequest",
              "X-CSRF-TOKEN": token
          },
          method: 'delete',
          credentials: "same-origin",
      }).then((data) => {
            Swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            );
            window.location.href = url+'bank';
      }).catch(function (error) {
          console.log(error);
      });
    }
</script>

@endsection