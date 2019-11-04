@extends('layouts.app')

@section('content')



<div class="container" >
        <div class="card">
                <div class="card-header">
                  Filtro de Registro
                </div>
                <div class="card-body">

                        <form id="search-form" class="form-horizontal" >

                                <div class="form-group" >
                                    <label>Nome/CRM:</label>
                                    <input name="q" id="search" value="" class="form-control" />
                                </div>

                                 <br />
                                 <div class="form-group">
                                  <input type="button" name="search"  class="btn btn-warning search" value="Pesquisar" />
                                 </div>
                               </form>

                </div>
              </div>
              <div class="card">
                    <div class="card-header">
                      Listagem de Registro
                    </div>
                    <div class="card-body">
                            <button type="button" class="btn btn-primary new " >Novo</button>
                            <table class="table table-bordered table-striped"  id="records_table" >
                                <thead>
                                    <tr >
                                      <th>#</th>
                                      <th>Nome</th>
                                      <th>CRM</th>
                                      <th>Telefone</th>
                                    </tr>

                                    </thead>

                                    <tbody>
                                    </tbody>
                              </table>

                    </div>
                  </div>

</div>
<div id="formModal" class="modal fade" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
         <div class="modal-content">
          <div class="modal-header">
                <h4 class="modal-title">Registro</h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <div class="modal-body">
                <span id="form_result"></span>
                <form method="post" id="sample_form" class="form-horizontal" >
                 @csrf
                 @csrf
                 <div class="form-group" >
                     <label>Nome:</label>
                     <input name="name" id="name" value="" class="form-control" />
                 </div>
                 <div class="form-group" >
                     <label>CRM:</label>
                     <input name="crm" id="crm" value=""  class="form-control" />
                 </div>
                 <div class="form-group" >
                     <label>Telefone:</label>
                     <input name="phone" id="phone" value=""  class="form-control" />
                 </div>
                 <div class="form-group" >
                     <label>Expecializações:</label>
                     <select class="form-control js-example-basic-multiple" name="expertises"  id='expertises' style="width:100%" multiple="multiple" ></select>
                  <br />
                 </div>
                  <div class="form-group">
                   <input type="hidden" name="action" id="action" />
                   <input type="hidden" name="hidden_id" id="hidden_id" />
                   <input type="button" name="action_button" id="action_button" class="btn btn-warning" value="Gravar" />
                  </div>
                </form>
               </div>
            </div>
           </div>
       </div>
@endsection

@section('js')



<script>
 $(document).ready(function(){

            var  urlInvoice = "{{ url('api/v1/doctors') }}";
            $.ajax({
                url: urlInvoice,
                type: 'GET',
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                cache: false,
                success: function (response) {
                  $('#records_table > tbody').empty();
                  var trHTML = '';
                    $.each(response, function (i, item) {
                        trHTML +=
                            '<tr>'+
                            '<td><button type="button"  id='+item.id+' class="btn btn-info edit" >Editar</button>'+
                                '<button  type="button"  id='+item.id+' class="btn btn-danger delete" >Excluir</button>' +
                            '</td>'+
                            '<td>' + item.name +
                            '</td><td>' + item.crm +
                            '</td><td>' + item.phone +
                            '</td></tr>';
                    });
                    $('#records_table').append(trHTML);
                }
            });
  });
</script>

<script>
       $(document).ready(function(){
            function search_doctors(){
                   var  urlInvoice = "{{ url('api/v1/doctors') }}";
                   $.ajax({
                       url: urlInvoice,
                       type: 'GET',
                       dataType: "json",
                       contentType: "application/json; charset=utf-8",
                       data: {params: $("#search").val()},
                       success: function (data) {
                           console.log(data)
                         $('#records_table > tbody').empty();
                         var trHTML = '';
                           $.each(data, function (i, item) {
                               trHTML +=
                                   '<tr>'+
                                   '<td><button type="button"  id='+item.id+' class="btn btn-info edit" >Editar</button>'+
                                       '<button  type="button"  id='+item.id+' class="btn btn-danger delete" >Excluir</button>' +
                                   '</td>'+
                                   '<td>' + item.name +
                                   '</td><td>' + item.crm +
                                   '</td><td>' + item.phone +
                                   '</td></tr>';
                           });
                           $('#records_table').append(trHTML);
                       }
                   });
                }

                $(document).on('click', '.search', function(){
                    search_doctors();
                });
         });
       </script>
<script>
        $(document).on('click', '.new', function(){
            $("#formModal").modal();
            $("#action").val('add');
        });
        $(document).on('click', '#action_button', function(event){
            event.preventDefault();
            if($('#action').val() == 'add')
            {
            var token = '{{ csrf_token() }}';
            var url_update =  "{{ url('api/v1/doctors') }}";




              $.ajax({
                  type: "POST",
                  url: url_update,
                  data: {_token: token,
                    name : $("#name").val(),
                    crm : $("#crm").val(),
                    phone : $("#phone").val(),
                    expertises : $("#expertises").val()
                },
                  success: function (data) {
                     alert('Registro salvo');
                     console.log(data);

                }, error: function (data) {
                    if(data.status == 401){
                        var errors = data.responseJSON;
                        $.each(data.responseJSON, function (key, value) {
                            alert(value);
                            location.reload();
                        });
                    }
                }
              });
            }
            if ($('#action').val() == 'edit')
            {
                var token = '{{ csrf_token() }}';
                var id = $('#hidden_id').val();
                var url_update =  "{{ url('api/v1/doctors/_id') }}".replace('_id', id);;
                var datas = {

            };
              $.ajax({
                  type: 'PUT',
                  url: url_update,
                  data: {_token: token,
                        name : $("#name").val(),
                        crm : $("#crm").val(),
                        phone : $("#phone").val(),
                        expertises : $("#expertises").val()
                    },
                  success: function (data) {
                     location.reload();
                }, error: function (data) {
                    if(data.status == 401){
                        var errors = data.responseJSON;
                        $.each(data.responseJSON, function (key, value) {
                            alert(value);
                            location.reload();
                        });
                    }
                }
              });
            }
        })
</script>
<script>
    $(document).on('click', '.edit', function(){
        var id = $(this).attr('id');
        $('#form_result').html('');
        urlEdit = "{{ url('api/v1/doctors/_id') }}".replace('_id', id);
        $.ajax({
           url : urlEdit,
            dataType: 'json',
            success: function(html){
                console.log(html)
                $("#name").val(html.name);
                $("#crm").val(html.crm);
                $("#phone").val(html.phone);
                $("#specialties").val(html.specialties);
                $("#hidden_id").val(html.id);
                $("#action").val('edit');
                $("#formModal").modal();
            }
        });
    });
</script>

<script>
        $(document).on('click', '.delete', function(){
            var id = $(this).attr('id');
            urlEdit = "{{ url('api/v1/doctors/_id') }}".replace('_id', id);
            $.ajax({
                type: 'DELETE',
                url : urlEdit,
                dataType: 'json',
                success: function(html){
                    alert('Registro Excluido!')
                    location.reload();
                }
            });
        });
    </script>



<script>
 $(document).ready(function(){
                $.getJSON(
                  '{{url("api/v1/expertises")}}',
                  {
                    client: $(this).val(),
                    ajax: 'true'
                  }, function(j){
                    var options = '<option value=""></option>';
                    for (var i = 0; i < j.length; i++) {
                      options += '<option value="' +
                        j[i].id + '">' +
                        j[i].description + '</option>';
                    }
                    $('#expertises').html(options).show();
                    $('.carregando').hide();
                  });

          });


    </script>

<script>
        $(document).ready(function() {
            $(".js-example-basic-multiple").select2();
            $(".js-example-basic-multiple").on("select2:select", function (evt) {
            var element = evt.params.data.element;
            var $element = $(element);

            $element.detach();
            $(this).append($element);
            $(this).trigger("change");
            });
        });
        </script>

@endsection
