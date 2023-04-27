<?php
    require_once __DIR__.'/config/config.inc.php';
    require_once __DIR__.'/classes/ConnectionMyDB.php'; 
    require_once(__DIR__.'/classes/Degree.php');
    require_once(__DIR__.'/classes/Department.php');

    // var_dump($_GET['id']);

    //open db connection
    $connection = new ConnectionMyDB(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $dep_id = $_GET['id'];

    $degrees = new Degree($connection);
    $degrees = $degrees->getAllDegreesForDepartment($dep_id);

    $department = new Department($connection);
    $department = $department->get_department_by_id($dep_id); 
    
    // var_dump($degrees);
    // var_dump($department);
?>

<body>
    <div class="container"></div>
    <?php //include __DIR__.'/src/partials/header.php'; ?>

    <?php if (!empty($degrees) && $degrees->num_rows > 0): ?>
        <h1> <?php echo $department->fetch_assoc()['name'] ?> </h1>
        <table>
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Degrees</th>
                <th scope="col">Level</th>
                <th scope="col">Address</th>
                <th scope="col">Email</th>
                <th scope="col">Website</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $degrees->fetch_assoc()): ?>  
                <tr>
                <th scope="row"><?php echo $row['id']; ?></th>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['level']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['website']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <?php echo "0 results"; ?>
    <?php endif; ?>
    <?php include __DIR__.'/src/partials/footer.php'; ?>
</body>
