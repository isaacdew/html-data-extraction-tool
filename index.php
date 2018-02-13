<head>
    <title>Html Data Extraction Tool</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="styles/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
<?php
if($_POST) {
    //Variables
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $schema = $_POST['schema'];
    $db_table = $_POST['table'];
    $table_col = $_POST['table_columns'];
    $tag = explode(", ", $_POST['tags']);
    $num_col = $_POST['num_columns'];
    $file = $_POST['file'];
    

    //Connect to database
    if ($conn = mysqli_connect('localhost', $user, $pass, $schema)) {

    } else {

      echo '<div class="alert alert-danger" role="alert">
                Failed to make a connection to the database. Please check your password and username.
            </div>';

    }
    //Get file
    $output = file_get_contents($file);
    
    //Find all the data in between selected tags
    preg_match_all("'" . $tag[0]. "(.*?)" . $tag[1] . "'si",$output,$table);

    $row = $table[1];

    //echo $table[0][1] . "<br>" . $table[0][0];

    $num_rows = count($row);
    

    $row_array = array();
    $c = 1;
    for($x = 0; $x < $num_rows; $x++) {
        //Strip HTML and add value to Row Array
        $row_array[] = "'" . strip_tags($row[$x]) . "'";
        
        //Echo Output
        echo "Line " . $x . ":" . strip_tags($row[$x]) . "<br>";
        
        //If we come to the end of a row, insert its values into the SQL table
        if($c % $num_col == 0) {
            //Format values for SQL Statement
            foreach($row_array as $row_value) {
                if($row_value == $row_array[0]) {
                    $values .= $row_value;
                } else {
                    $values .= "," . $row_value;
                }
            }
            //Insert row into table
            $sql = "INSERT INTO $db_table ($table_col) VALUES($values)";
            mysqli_query($conn, $sql);
            
            //Test Possible SQL Issues
            //echo $sql . "<br>";
            //echo mysqli_error($conn) . "<br>";

            //Reset values for next iteration
            $values = "";
            $row_array = array();

            echo "<b>END OF ROW</b> <br>";
        }
        $c++;
    }
}
?>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card">
                    <div class="card-body">
                        <form action="parse_hipaa.php" method="post">
                            Database Username: <input type="text" name="username" class="form-control">
                            Database Password: <input type="password" name="password" class="form-control">
                            Database Schema:   <input type="text" name="schema" class="form-control">
                            Database Table: <input type="text" name="table" class="form-control">
                            Database Table Columns (separated by comma): <input type="text" name="table_columns" class="form-control" placeholder="name, email">
                            Tags to Extract Data from (Opening and closing separated by comma & a space): <input type="text" name="tags" class="form-control" placeholder="<td>, </td>">
                            Number of Columns in HTML Table: <input type="number" name="num_columns" class="form-control">
                            HTML File To Extract Data from: <input type="text" name="file" class="form-control" placeholder="/home/user/Documents/data.html">
                            <button class="btn btn-primary form-control">Extract Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>