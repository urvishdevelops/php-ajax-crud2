<?php
include 'crud.php';

$crud = new crud();

?>



<html>

<head>
    <title>Add Data</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <link href="toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>

<body>

    <div class="container justify-content-center mt-5" style="margin-top: 05%">

        <!-- Add -->

        <form id="ytForm" onsubmit="return false;" enctype="multipart/form-data">
            <input type="hidden" name="type" value="insert">
            <input type="hidden" name="hiddenId" id="hiddenId">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name">
            </div>
            <div class="mb-3">
                <label for="cname" class="form-label">Channel Name</label>
                <input type="text" name="cname" class="form-control" id="cname">
            </div>
            <div class="mb-3">
                <label for="bizmail" class="form-label">Business Email</label>
                <input type="email" name="bizmail" class="form-control" id="bizmail">
            </div>
            <div class="mb-3">
                <input id="profile" type="file" name="profile" />
            </div>
            <div class="mb-3 col-3">
                <select class="form-select form-select-sm mb-4" aria-label=".form-select-lg example" id="status"
                    name="status">
                    <option selected>Open this select menu</option>
                    <option value="1">active</option>
                    <option value="2">inactive</option>
                </select>
            </div>

            <button type="submit" id="ytFormButton" class="btn btn-primary" value="Submit">Submit</button>
        </form>



        <!-- View  -->
        <div class="form-outline w-50 mt-5 d-flex flex-end">
            <input type="email" placeholder="Search her|"
                class="form-control input-sm border border-info border-2 mb-3  " id="ytsearch">
        </div>
        <table class="table table-striped  table-bordered mt-5">
            <thead>

                <tr>
                    <td>Id <a class="inc"><i class='fa fa-arrow-up'></a> <a class="dec"><i
                                class='fa fa-arrow-down dec'></a></td>
                    <td>Name <a class="inc"><i class='fa fa-arrow-up'></a> <a class="dec"><i
                                class='fa fa-arrow-down dec'></a>
                    </td>
                    <td>Channel Name<a class="inc"><i class='fa fa-arrow-up'></a> <a class="dec"><i
                                class='fa fa-arrow-down dec'></a>
                    </td>
                    <td>Biz Mail<a class="inc"><i class='fa fa-arrow-up'></a> <a class="dec"><i
                                class='fa fa-arrow-down dec'></a></td>
                    <td>Status<a class="inc"><i class='fa fa-arrow-up'></a> <a class="dec"><i
                                class='fa fa-arrow-down dec'></a></td>
                    <td>Youtubers Profile</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody id="tbody">


            </tbody>
        </table>
        <div id='pagination'></div>
    </div>
</body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="index.js">
    <script src="toastr.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"
    integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>

</html>