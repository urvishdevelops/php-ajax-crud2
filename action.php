<?php
include "crud.php";

$crud = new Crud();



switch ($_POST['type']) {
    case 'insert':
        $name = $_POST['name'];
        $channelname = $_POST['cname'];
        $bizmail = $_POST['bizmail'];
        $hiddenId = $_POST['hiddenId'];



        if (!empty($hiddenId)) {
            $query = "UPDATE youtuber SET id='$hiddenId', name='$name', channelname='$channelname', bizmail='$bizmail' where id='$hiddenId';";
        } else {
            $query = "INSERT INTO youtuber(name, channelname, bizmail)VALUES('$name', '$channelname', '$bizmail');";
        }


        echo $query;
        $result = $crud->dataExecutor($query);




        if ($result) {
            return 1;
        } else {
            return 0;
        }
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
        $crud = new Crud();
        $query = $crud->delete($deleteId);
        break;


    case 'listing':

        $query = "SELECT * FROM youtuber";

        $result = $crud->dataProvider($query);

        $html = '';

        foreach ($result as $key => $value) {
            $id = $value['id'];
            $html .= "<tr>";
            $html .= "<td class='id'>" . $value['id'] . "</td>";
            $html .= "<td>" . $value['name'] . "</td>";
            $html .= "<td>" . $value['channelname'] . "</td>";
            $html .= "<td>" . $value['bizmail'] . "</td>";
            $html .= "<td>" . "</td>";
            $html .= "<td><a class='btn btn-warning edit' id='$id'>Edit</a> | <a class='btn btn-danger delete' id='$id'>Delete</a>";
            $html .= "</tr>";
        }

        $htmlArr['tbody'] = $html;

        echo json_encode($htmlArr);


        break;

    default:
        # code...
        break;
}



?>