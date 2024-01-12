<?php
include "crud.php";

$crud = new Crud();



switch ($_POST['type']) {
    case 'insert':
      
        $response['status'] = 0;
        $name = $_POST['name'];
        $channelname = $_POST['cname'];
        $bizmail = $_POST['bizmail'];
        $hiddenId = $_POST['hiddenId'];
        $status = $_POST['status'];

     

        if($_FILES["profile"]["name"] != ''){
            $filename = $_FILES["profile"]["name"];
            $tempImg = $_FILES["profile"]["tmp_name"];
            $folder = "./tempimg/" . $filename;
            move_uploaded_file($tempImg, $folder);
        }
        
        
        if ($hiddenId  > 0) {
            if(isset($filename)){
                $query = "UPDATE youtuber SET id='$hiddenId', name='$name', channelname='$channelname', bizmail='$bizmail', profile='$filename',  status = '$status' where id='$hiddenId';";
              
            }else{
                $query = "UPDATE youtuber SET id='$hiddenId', name='$name', channelname='$channelname', bizmail='$bizmail',  status = '$status' where id='$hiddenId';";
               
            }
            $result = $crud->dataExecutor($query);
            if ($result) {
                $response['status'] = 1;
                $response['message'] = "Data updated successfully";
            } else {
                $response['message'] = "Insert corrrect data!";
            }
        } else {
           
                $query = "INSERT INTO youtuber(name, channelname, bizmail, profile, status)VALUES('$name', '$channelname', '$bizmail', '$filename', '$status');";
                $result = $crud->dataExecutor($query);


                if ($result) {
                    $response['status'] = 1;
                    $response['message'] = "Data inserted successfully";
                } else {
                    $response['message'] = "Insert corrrect data!";
                }
           

        }

        print_r(json_encode($response));

        break;


    case 'edit':
        $editId = $_POST['editId'];
        $crud = new Crud();
        $query = "SELECT * from youtuber WHERE id='$editId';";
        $result = $crud->dataProvider($query);
        echo json_encode($result);
        break;


    case 'delete':
        $deleteId = $_POST['deleteId'];
        $query = $crud->delete('youtuber', $deleteId);

        break;


    case 'ytVal':
        $ytVal = $_POST['ytVal'];

        $crud = new crud();


        $query = "SELECT * FROM youtuber where name like '%$ytVal%' or id like '%$ytVal%' or bizmail like '%$ytVal%' or channelname like '%$ytVal%' or status like '%$ytVal%'";



        $result = $crud->dataExecutor(($query));

        $record = "";

        foreach ($result as $row) {
            $image = $row['profile'];
            $path = "./tempImg/$image";
            $record .= "<tr> 
                <td>$row[id]</td>
                <td>$row[name]</td>
                <td>$row[channelname]</td>
                <td>$row[bizmail]</td>
                <td>$row[status]</td>
                <td><img src=$path height='100' width='100' id='profile'></td>;
                <td><a class='btn btn-warning edit' id='$row[id]'>Edit</a> | <a class='btn btn-danger delete' id='$row[id]'>Delete</a>
                </tr>";
        }
        echo $record;
        break;


    case 'listing':

        $html = '';
        $htmlarr = [];
        $pagination = "";
        $sort = $_POST['sort'];


        // pagination 

        $limit = 5;
        $page = isset($_POST['page']) ? $_POST['page'] : 1;

        $start_from = ($page - 1) * $limit;


        $total_rows = $crud->dataExecutor("SELECT COUNT(id) as total FROM youtuber");

        foreach ($total_rows as $key => $value) {
            $row_count = $value['total'];
        }

        $total_pages = ceil($row_count / $limit);




        if ($sort) {
            $query = "SELECT * FROM youtuber ORDER BY id $sort, name $sort, bizmail $sort, channelname $sort, status $sort LIMIT $start_from, $limit";
        } else {
            $query = "SELECT * FROM youtuber LIMIT $start_from, $limit";
        }


        $result = $crud->dataProvider($query);

        foreach ($result as $key => $value) {
            $id = $value['id'];
            $image = $value['profile'];
            $path = "./tempImg/$image";
            $html .= "<tr>";
            $html .= "<td class='id'>" . $value['id'] . "</td>";
            $html .= "<td>" . $value['name'] . "</td>";
            $html .= "<td>" . $value['channelname'] . "</td>";
            $html .= "<td>" . $value['bizmail'] . "</td>";
            $html .= "<td>" . $value['status'] . "</td>";
            $html .= "<td>" . " <img src=$path height='100' width='100' id='profile'>" . "</td>";
            $html .= "<td><a class='btn btn-warning edit' id='$id'>Edit</a> | <a class='btn btn-danger delete' id='$id'>Delete</a>";
            $html .= "</tr>";
        }

        $htmlArr['tbody'] = $html;


        $pagination .= '<ul class="pagination">';

        if ($page > 1) {
            $previous = $page - 1;
            $pagination .= '<li class="page-item" id="1"><span class="page-link">First Page</span></li>';
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            $active_class = ($i == $page) ? "active" : "";

            $pagination .= '<li class="page-item ' . $active_class . '" id="' . $i . '"><span class="page-link">' . $i . '</span></li>';
        }

        $pagination .= '<li class="page-item" id="' . $total_pages . '"><span class="page-link">Last Page</span></li>';
        $pagination .= '</ul>';
        $htmlArr['pagination'] = $pagination;

        echo json_encode($htmlArr);



        break;

    default:
        # code...
        break;
}



?>