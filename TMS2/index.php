<?php session_start();
include ("config.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>

 <div class="container-fluid mt-4">
 <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h1 class="card-title text-center" style="font-weight: bold;";>Task Management</h1>

              <a href="create_task.php" style="float: right;" class="btn btn-primary">Add task</a>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th class="col">Title</th>
                    <th class="col">Description</th>
                    <th class="col">Priority</th>
                    <th class="col">Due date</th>
                  </tr>
                </thead>
                <tbody>


                <?php
                $query = "SELECT * FROM `tasks`";
                $query_run = mysqli_query($con, $query);
                if(mysqli_num_rows($query_run) > 0)
                {
                foreach($query_run as $row)
                {
                ?>
                    <tr>
                <td><?= $row['title']; ?></td>
                <td><?= $row['description']; ?></td>
                <td><?= $row['priority']; ?></td>
                <td><?= $row['due_date']; ?></td>

                <td>
                
                <div class="btn-container" style="display: flex; justify-content: end;">
                  <div class="btn" style="padding: 0; margin-left: 5px;">
                      <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $row['id']; ?>">VIEW</a>
                  </div>

                    <div class="btn" style="padding: 0; margin-left: 5px" >
                        <a type="button" class="btn btn-warning" href="edit_task.php?id=<?=$row['id'];?>" >UPDATE</a>
                    </div>

                    <div class="btn" style="padding: 0; margin-left: 5px">
                        <form action="delete_task.php" method="POST">
                            <input type="hidden" name="id" id="id" value="<?= $row['id']; ?>">
                            <button type="submit" class="btn btn-danger">DELETE</button>
                        </form>
                    </div>
                </div>

               
                <!-- Modal bootstrap -->
                <div class="modal fade" id="exampleModal<?= $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Task Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <p><strong>Title:</strong> <?= $row['title']; ?></p>
                            <p><strong>Description:</strong> <?= $row['description']; ?></p>
                            <p><strong>Priority:</strong> <?= $row['priority']; ?></p>
                            <p><strong>Due Date:</strong> <?= $row['due_date']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                

              </td>
                    </tr>

                    <?php
                } 
                } else
                {
                ?>
                <tr>
                <td colspan="6">No Record Found</td>
                </tr>
                <?php
                }
                ?>

                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
 </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
if (isset($_SESSION['status']) && $_SESSION['status_code'] != '' )
{
    ?>
        <script>
            swal({
                title: "<?php echo $_SESSION['status']; ?>",
                icon: "<?php echo $_SESSION['status_code']; ?>",
            });
        </script> 
        <?php
        unset($_SESSION['status']);
        unset($_SESSION['status_code']);
}
?>

  </body>
</html>