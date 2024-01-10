$(document).ready(function () {

    $(function () {
        listing()

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
                    listing()
                    clearForm()

                }
            });
        })


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

                    $("#name").val(name);
                    $("#hiddenId").val(editId);
                    $("#cname").val(channelname);
                    $("#bizmail").val(bizmail);
                }
            });
        })


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

    function listing(params) {
        $.ajax({
            type: "POST",
            data: {
                type: "listing"
            },
            url: "action.php",
            success: function (data) {
                let parsedData = JSON.parse(data);

                let tbodyData = parsedData['tbody'];

                $('#tbody').html(tbodyData)
            }

        });
    }


    function clearForm() {
        document.getElementById('ytForm').reset();
    }
})