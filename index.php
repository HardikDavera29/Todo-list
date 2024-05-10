<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link rel="stylesheet" href="boot.css">
</head>

<body>
    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModal">Edit Note</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!--Form of modal -->
                    <form action="index.php" method="post">
                        <input type="hidden" name="idEdit" id="idEdit">
                        <input type="text" name="title" id="title" class="form-control" required>
                        <textarea name="Descs" id="Descs" class="form-control mt-3" required></textarea>
                        <button type="button" class="btn btn-secondary mt-3" data-bs-dismiss="modal">Close</button>
                        <input type="submit" value="Edit note" class="btn btn-primary mt-3 w-50">
                    </form>
                    <!-- End of modal form-->
                </div>
            </div>
        </div>
    </div>
    <?php
        $insert1 = false;
        $insert2 = false;
        include "configuration.php";
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            if(isset($_POST['idEdit']))
            {
                $id1 = $_POST['idEdit'];
                $title = $_POST['title'];
                $Descs = $_POST['Descs'];
                $update = "UPDATE `todo1` SET `note` = '$title' , `note1` = '$Descs' WHERE `todo1`.`id` = '$id1'";
                $run = mysqli_query($con,$update);
                $insert2 = true;
            }
            else
            {
                $head = $_POST['Head'];
                $note = $_POST['Note'];
                $insert = "INSERT INTO `todo1`(`note`,`note1`) values('$head','$note')";
                $insert1 = true;
                $run = mysqli_query($con,$insert);
            }
           
        }
    ?>
    <?php
        if($insert1==true)
        {   
            echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Successfully</strong> Insert your note.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
        }
        else if( $insert2 == true)
        {
            echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Successfully</strong> Update your note.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
        }
       
    ?>
    <div class="container mt-5 p-3">

        <form action="index.php" method="POST" class="form-control p-5">
            <h1 class="mb-4">TODO LIST</h1>
            <input type="text" name="Head" class="form-control" placeholder="Write Heading..." required>
            <textarea name="Note" class="form-control mt-3" placeholder="Write Note Descripation..." required></textarea>
            <input type="submit" name="btn" value="Add note" class="btn btn-primary mt-3 w-100">
        </form>
    </div>
    
    <div class="container mt-5">
        <table class="table table-strip table-hover" id="myTable" class="display">
            <tr>
                <th>NO.</th>
                <th>HEADING</th>
                <th>DESCRIPATION</th>
                <th>EDIT</th>
            </tr>
            <?php
                $select = "SELECT * FROM `todo1`";
                $Qrun = mysqli_query($con,$select);
                
                $no=1;
                while($row = mysqli_fetch_assoc($Qrun))
                {
            ?>
            <tr>
                <td>
                    <?php echo $no;?>
                </td>
                <td>
                    <?php echo $row['note'];?>
                </td>
                <td>
                    <?php echo $row['note1'];?>
                </td>
                <td>
                    <button class="btn btn-danger btn-sm"><a href="delete.php?id=<?php echo $row['id'];?>"
                    style="text-decoration:none;" class="text-light">DELETE</a></button>
                    <button class="edit btn btn-warning btn-sm" data-toggle="modal" id="<?php echo $row['id'];?>">EDIT</button>

                </td>
            </tr>
            <?php
            $no++;
                }
            ?>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        edits = document.getElementsByClassName("edit");
        Array.from(edits).forEach((elements) => {
            elements.addEventListener("click", (e) => {
                console.log("edit",);
                tr = e.target.parentNode.parentNode;
                head = tr.getElementsByTagName("td")[1].innerText;
                desc = tr.getElementsByTagName("td")[2].innerText;
                console.log(head, desc);
                title.value = head;
                Descs.value = desc;
                idEdit.value = e.target.id;
                $('#editModal').modal('toggle');
            });
        });

    </script>

</body>

</html>