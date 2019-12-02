<?php
session_start();

if(!isset($_SESSION['username'])){
    header('location: login.php');
}
//Error Reporting on
//ini_set("display_errors",1);
//error_reporting(E_ALL);

?>
<!doctype html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">

    <title>Document</title>
</head>
<body>
    <div class="container">
        <h3>Guest Summary</h3>

        <?php
            //connection to the database
            require '/home2/orovinsk/connectGuest.php';

            $sql = "SELECT first_name, last_name, meet_type, company, job_tittle, link_url, comments, 
                    mail_list, email, join_date FROM `person` 
                    INNER JOIN guest_book ON person.person_id = guest_book.person_id";

            $result = mysqli_query($cnxn, $sql)
        ?>
        <table id="guest-table" class="display">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Meeting Type</th>
                    <th>Company</th>
                    <th>Job Tittle</th>
                    <th>Linkden URL</th>
                    <th>Thoughts</th>
                    <th>Mailing List</th>
                    <th>E-Mail</th>
                    <th>Date Joined</th>
                </tr>
            </thead>
            <tbody>
            <?php
                while($row = mysqli_fetch_assoc($result)){
                    $firstName = $row['first_name'];
                    $lastName = $row['last_name'];
                    $meetType = $row['meet_type'];

                    //company
                    if($row['company'] !== ""){
                        $company = $row['company'];
                    }
                    else{
                        $company = 'N/A';
                    }

                    //job tittle
                    if($row['job_tittle'] !== ""){
                        $jobTittle = $row['job_tittle'];
                    }
                    else{
                        $jobTittle = 'N/A';
                    }

                    //linkden url
                    if($row['link_url'] !== ""){
                        $link = $row['link_url'];
                    }
                    else{
                        $link = 'N/A';
                    }

                    //comments
                    if($row['comments'] !== ""){
                        $comment = $row['comments'];
                    }
                    else{
                        $comment = 'N/A';
                    }

                    //mailing list
                    if($row['mail_list'] == "1" ){
                        $mailList = 'agreed';
                    }
                    else{
                        $mailList = 'disagreed';
                    }

                    //email
                    if($row['email'] !== ""){
                        $eMail = $row['email'];
                    }
                    else{
                        $eMail = 'N/A';
                    }

                    $joinDate = date('m/d/Y', strtotime($row['join_date']));

                    echo "<tr>
                            <td>$firstName $lastName</td>
                            <td>$meetType</td>
                            <td>$company</td>
                            <td>$jobTittle</td>
                            <td>$link</td>
                            <td>$comment</td>
                            <td>$mailList</td>
                            <td>$eMail</td>
                            <td>$joinDate</td>
                          </tr>";
                }
            ?>
            </tbody>
        </table>
        <h5 class="text-center"><a href="../guestbook.html">Add Guest</a></h5>
    </div>
</body>
<!-- jQuery first, then Popper.js, Bootstrap JS then personal validation script-->
<script src="//code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="../scripts/dataTable.js"></script>
</html>
