$(document).ready(function () {


    $('#ytForm').validate({
        rules: {
            name: "required",
            bizmail: {
                required: true,
                email: true
            },
            cname: "required",
            status: "required",
        }, messages: {
            name: "Please enter your youtuber's name!",
            bizmail: {
                required: "Please enter your youtuber's email address!",
                bizmail: "Please enter valid email address!"
            },
            cname: "Enter a channel name!",
            status: "Enter a status type!",
        },
        submitHandler: function (form) {
            $('#ytForm').on("submit", (e) => {
                let formData = new FormData(document.getElementById('ytForm'));
                console.log("FormData", formData);
                $.ajax({
                    type: "POST",
                    data: formData,
                    url: "action.php",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        let res = JSON.parse(data)

                        if (res.status == 1) {
                            console.log("yup!");
                            listing();
                            clearForm();
                            toastr.success(res.message, { timeOut: 1000 })
                        } else {
                            toastr.error(res.message, { timeOut: 2000 })
                        }
                    }
                });
            })
        }

    })


    $(function () {
        listing()



        $(document).on('click', '.edit', function () {

            let editId = $(this).attr("id");
            $.ajax({
                type: "POST",
                data: {
                    type: "edit",
                    editId: editId
                },
                url: "action.php",
                success: function (data) {
                    let parsedEditData = JSON.parse(data);
                    var editId = parsedEditData[0].id;
                    let name = parsedEditData[0].name;
                    let channelname = parsedEditData[0].channelname;
                    let bizmail = parsedEditData[0].bizmail;
                    let himage = parsedEditData[0].profile;
                    let status = parsedEditData[0].status;

                    console.log("himage", himage);

                    let statustype = '';

                    console.log(parsedEditData);

                    if (status == "active") {
                        statustype = 1;
                    } else {
                        statustype = 2;
                    }


                    $("#name").val(name);
                    $("#hiddenId").val(editId);
                    $("#cname").val(channelname);
                    $("#bizmail").val(bizmail);
                    $("#himage").val(himage);
                    let stat = document.getElementById('status').value = statustype;
                    console.log('stat', stat);
                }
            });
        })


        $(".dec").on("click", (e) => {

            console.log('Yo! dec');
            let dec = "DESC";
            listing(dec);
        });


        $(".inc").on("click", (e) => {

            console.log('Yo! inc');

            let asc = "ASC";
            listing(asc);
        });


        $(document).on('click', '.delete', function () {

            let deleteId = $(this).attr("id");

            $.ajax({
                type: "POST",
                data: {
                    type: "delete",
                    deleteId: deleteId
                },
                url: "action.php",
                success: function (data) {
                    listing()
                }
            });
        })
    })

    $("#ytsearch").on("keyup", function () {
        let ytVal = $("#ytsearch").val();
        $.ajax({
            type: "POST",
            url: "action.php",
            data: {
                type: "ytVal",
                ytVal: ytVal,
            },
            success: function (data) {
                $("#tbody").html(data);
            },
        });
    });

    $(document).on('click', '.page-item', function () {
        let page = $(this).attr("id");

        listing("", page);
    })

    function listing(sorting = 'asc', page = 1) {
        $.ajax({
            type: "POST",
            data: {
                type: "listing",
                sort: sorting,
                page: page
            },
            url: "action.php",
            success: function (data) {
                let parsedData = JSON.parse(data);

                let tbodyData = parsedData['tbody'];
                let pagination = parsedData['pagination'];

                console.log("pagination", parsedData);

                $('#tbody').html(tbodyData)
                $("#pagination").html(pagination);
            }

        });
    }


    function clearForm() {
        document.getElementById('ytForm').reset();
    }
})