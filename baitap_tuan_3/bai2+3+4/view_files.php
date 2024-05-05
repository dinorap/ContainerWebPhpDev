<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Files</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th:hover {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>View Files</h2>
    <table id="fileTable">
        <tr>
            <th onclick="sortTable(0)">File Name</th>
            <th onclick="sortTable(1)">File Type</th>
            <th onclick="sortTable(2)">Upload Date</th>
            <th onclick="sortTable(3)">File Size</th>
            <th>Delete</th>
        </tr>
        <?php
        // Lấy danh sách tệp trong thư mục upload
        $files = glob("upload/*");
        foreach ($files as $file) {
            $fileName = basename($file);
            $fileType = pathinfo($file, PATHINFO_EXTENSION);
            $uploadDate = date("Y-m-d H:i:s", filemtime($file));
            $fileSize = filesize($file);
            echo "<tr><td>$fileName</td><td>$fileType</td><td>$uploadDate</td><td>$fileSize bytes</td><td><a href='#' onclick='deleteFile(\"$fileName\")'>Delete</a></td></tr>";
        }
        ?>
    </table>
    <script>
        function sortTable(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.querySelector('table');
            switching = true;
            // Set the sorting direction to ascending:
            dir = "asc";
            /* Make a loop that will continue until
            no switching has been done: */
            while (switching) {
                // Start by saying: no switching is done:
                switching = false;
                rows = table.rows;
                /* Loop through all table rows (except the
                first, which contains table headers): */
                for (i = 1; i < (rows.length - 1); i++) {
                    // Start by saying there should be no switching:
                    shouldSwitch = false;
                    /* Get the two elements you want to compare,
                    one from current row and one from the next: */
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    /* Check if the two rows should switch place,
                    based on the direction, asc or desc: */
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            // If so, mark as a switch and break the loop:
                            shouldSwitch= true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            // If so, mark as a switch and break the loop:
                            shouldSwitch= true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    /* If a switch has been marked, make the switch
                    and mark that a switch has been done: */
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    // Each time a switch is done, increase this count by 1:
                    switchcount ++;
                } else {
                    /* If no switching has been done AND the direction is "asc",
                    set the direction to "desc" and run the while loop again. */
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }

        function deleteFile(fileName) {
            if (confirm("Are you sure you want to delete this file?")) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("fileTable").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "delete_file.php?file=" + fileName, true);
                xhttp.send();
            }
        }
    </script>
</body>
</html>
