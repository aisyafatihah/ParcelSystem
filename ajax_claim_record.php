<?php

            ## Database configuration
            include 'config.php';

            ## Read value
            $draw = $_POST['draw'];
            $row = $_POST['start'];
            $rowperpage = $_POST['length']; // Rows display per page
            $columnIndex = $_POST['order'][0]['column']; // Column index
            $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
            $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
            $searchValue = mysqli_real_escape_string($conn,$_POST['search']['value']); // Search value

            ## Search 
            $searchQuery = " ";
            if($searchValue != ''){
               $searchQuery = " and (ID like '%".$searchValue."%' or 
                  tracking like'%".$searchValue."%' ) ";
            }

            ## Total number of records without filtering
            $sel = mysqli_query($conn,"select count(*) as allcount from transaction");
            $records = mysqli_fetch_assoc($sel);
            $totalRecords = $records['allcount'];

            ## Total number of record with filtering
            $sel = mysqli_query($conn,"select count(*) as allcount from transaction WHERE 1 ".$searchQuery);
            $records = mysqli_fetch_assoc($sel);
            $totalRecordwithFilter = $records['allcount'];

            ## Fetch records
            $empQuery = "select * from transaction WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
            $empRecords = mysqli_query($conn, $empQuery);
            $data = array();

            while ($row = mysqli_fetch_assoc($empRecords)) {
               $data[] = array( 
                  "ID"=>$row['ID'],
                  "date"=>$row['date'],
                  "location"=>$row['location'],
                  "phoneNo"=>$row['phoneNo'],
                  "tracking"=>$row['tracking']
               );
            }

            ## Response
            $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
            );

            echo json_encode($response);

      




