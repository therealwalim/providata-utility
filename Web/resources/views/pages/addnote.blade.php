@extends('main')

@section('variables')
    @php
        $company="Providata";
        $title="Tasks";
        $page="Add Task";
    @endphp
@stop

@section('content')

    <section id="floating-label-layouts">
        <div class="row match-height">
            <div class="col-md-6 col-12">
                <div class="card" style="height: 310.283px;">
                    <div class="card-header">
                        <h4 class="card-title">Add a note</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-label-group">
                                                <input type="text" id="first-name-floating" class="form-control" placeholder="Title" name="title">
                                                <label for="first-name-floating">Title</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <fieldset class="form-label-group">
                                                <textarea class="form-control" id="email-floating" rows="3" placeholder="Content" name="contenu"></textarea>
                                                <label for="email-floating">Content</label>
                                            </fieldset>
                                        </div>
                                        <div class="col-12">
                                            <button id="addnote" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Submit</button>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
            </div>
            </div>
        </div>
    </section>

    <script>

        // Set menu active
        var element = document.getElementById("Tasks");
        element.classList.add("active");

        // Hide card test

        // Function to create note
        $("#addnote").click(function(e){
            var title = $("input[name=title]").val();
            var content = $('#email-floating').val();
            $.ajax({
                url: "{{route('note.create')}}",
                method: "post",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {title:title,contenu:content},
                success: function (data) {
                    if(data == "created")
                    {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'bottom-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: 'Note created with success'
                        })
                    }
                }
            })
        });
    </script>

@endsection

