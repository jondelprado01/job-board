$(document).ready(function(){

    $("#btn_add_qual").on("click", function(){

        let qual = $("#job_qualification").val();
        let id = Math.floor(Math.random() * 100);

        if (qual != "") {
            $(".qualification_container").append(
                '<div id="qual'+id+'" class="input-group mb-3">'+
                    '<input type="text" class="form-control rounded colored job-input" name="qualification[]" value="'+qual+'">'+
                    '<button class="btn btn-outline-danger btn_remove_qual" type="button" id="'+id+'">'+
                        '<i class="fa-solid fa-x"></i>'+
                    '</button>'+
                '</div>'
            );
            $('#job_qualification').val('');
        }

        $(".btn_remove_qual").on("click", function(){
            let qual_id = $(this).attr("id");
            $("#qual"+qual_id).remove();
        });
    });


    $(".btn_save_post").on("click", function(){

        var form = new FormData();

        $(".job-input").each(function(){
            form.append($(this).attr("name"), $(this).val());
        });

        $.ajax({
            type: "post",
            url: "/api/add-job",
            processData: false,
            contentType: false,
            cache: false,
            data: form,
            dataType: "json",
            beforeSend: function(){
                loader();
            },
            success: function(data){
                setTimeout(function(){
                if (data == 1) {
                    successMessage("Saved");
                }
                }, 1500);
            },
            error: function(xhr, status, error) {
                console.log(xhr);
                setTimeout(function(){
                    requestError(xhr.responseJSON.errors);
                }, 1500);
            }
        });

    });

    $(".btn_edit").on("click", function(){
        let status = $(this).attr("data-status");
        let id = $(".post_id").val();
        $.ajax({
            type: "post",
            url: "/api/edit-job-post/"+id,
            data: {
                status: status,
            },
            dataType: "json",
            beforeSend: function(){
                loader();
            },
            success: function(data){
                console.log(data);
                setTimeout(function(){
                if (data == 1) {
                    successMessage("Saved");
                }
                }, 1500);
            },
            error: function(xhr, status, error) {
                console.log(xhr);
                setTimeout(function(){
                    requestError(xhr.responseJSON.errors);
                }, 1500);
            }
        });
    });
    
});

function loader(){
    swal.fire({
    title: "Processing please wait....",
    allowEscapeKey: false,
    allowOutsideClick: false,
    showConfirmButton: false,
    didOpen: () => {
        swal.showLoading();
    }
    });
}

function successMessage(type){
    swal.fire({
        icon: "success",
        title: "Success!",
        html: "<b class='swal_success'>Record "+type+" Successfully.</b>",
    }).then(function(){
        window.location.reload();
    });
}

function requestError(error){

    var err_msg = "";

    $.each(error, function(key, value){
        err_msg += value+"<br>";
    });

    Swal.fire({
        icon: "error",
        title: "Something went Wrong!",
        html: err_msg,
    });

}