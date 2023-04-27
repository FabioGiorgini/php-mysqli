<?php
require_once __DIR__.'/config/config.inc.php';
require_once __DIR__.'/classes/ConnectionMyDB.php'; 
require_once __DIR__.'/classes/Department.php';
require_once __DIR__.'/server.php';

$error = null;
// $result = null;
try {
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    //open db connection
    $connection = new ConnectionMyDB(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // var_dump($_SESSION);
    // die();

    //check login
    if(!empty($_POST['user']) && !empty($_POST['pass'])){
        login($_POST['user'], $_POST['pass'], $connection);
    }

    //check session
    if(!empty($_SESSION['userId'])){     
        //handle departments
        $department = new Department($connection);
    
        //get the id if exists or null
        $id = $_GET['id'] ?? null;
        
        if($id){
            $result = $department->get_department_by_id($id);
        } else {
            $result = $department->get_all_departments();
        }
    }
    

} catch (Exception $e) {
    $error = $e->getMessage();
}

$page_title = 'Departments';

?>
<?php include __DIR__.'/src/partials/head.php'; ?>

<?php if (empty($_SESSION['userId'])) { ?>
    <body>
        <div class="container">
            <form method="POST" action="index.php" class="w-50 bg-dark text-light rounded p-4">
                <div class="mb-3">
                    <label for="name" class="form-label">Username</label>
                    <input type="text" class="form-control" id="user" name="user" value="mario">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="password">
                </div>
                <div class="">
                    <button type="submit" class="btn btn-info mb-3">Login</button>
                </div>
            </form>
        </div>
    </body>
<?php } else if(!empty($_SESSION['userId'])) { ?>

    <body class="departments">
        <div class="container">
        <?php include __DIR__.'/src/partials/header.php'; ?>
        <?php if(!$error): ?>
        <?php if (!empty($result) && $result->num_rows > 0): ?>

            <table>
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Department</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Website</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>  
                    <tr>
                    <th scope="row"><?php echo $row['id']; ?></th>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['website']; ?></td>
                    <td>
                        <a href="detail.php?id=<?php echo $row['id']; ?>">Vai al dettaglio</a>
                    </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <?php echo "0 results"; ?>
        <?php endif; ?>
    <?php $connection->conn->close(); ?>
        <?php else: ?>
        <p> <?php echo $error; ?></p>
        <?php endif; ?>
        </main>
    <?php include __DIR__.'/src/partials/footer.php'; ?>

<?php } ?>
