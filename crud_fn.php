<?php

// Get Query function from https://github.com/sathishkumar63/Query-Function

$app->get('/names', function ($request, $response, $arguments) {
    $qry = "SELECT * FROM table_name";
    $executeQry = selectAllQry($qry);
    return $response->write(json_encode($executeQry));
});

$app->get('/name/{id}', function ($request, $response, $arguments) {
    $id = $request->getAttribute('id');
    $qry = "SELECT * FROM table_name WHERE Id = '$id'";
    $executeQry = selectQry($qry);
    return $response->write(json_encode($executeQry));
});

$app->post('/name', function ($request, $response, $arguments) {
    $postData = json_decode($request->getBody());
    $postData->Name = isset($postData->Name) ? $postData->Name : ''; 

    if ($postData->Name == '') {
        $res['Status'] = "false";
        $res['Message'] = "Required Field Missing";
        return $response->write(json_encode($res));
        die;
    }

    $heroId = randomId(4);
    $qry = "INSERT INTO table_name (Name, Id) VALUES ('$postData->Name','$Id')";
    $executeQry = actionQry($qry, "Table Added ", "insert");
    return $response->write(json_encode($executeQry));
});

$app->put('/name', function ($request, $response, $arguments) {
    $postData = json_decode($request->getBody());
    $postData->Id = isset($postData->Id) ? $postData->Id : ''; 
    $postData->Name = isset($postData->Name) ? $postData->Name : ''; 
     
    if ($postData->Name == '' && $postData->Id) {
        $res['Status'] = "false";
        $res['Message'] = "Required Field Missing";
        return $response->write(json_encode($res));
        die;
    }
    $qry = "UPDATE table_name SET Name = '$postData->Name' WHERE Id = '$postData->Id'";
    $executeQry = actionQry($qry, "Table Update ", "update");
    return $response->write(json_encode($executeQry));
});

$app->delete('/name/{id}', function ($request, $response, $arguments) {
    $id = $request->getAttribute('id');
    $qry = "DELETE FROM table_name WHERE Id = '$id'";
    $executeQry = actionQry($qry, "Table Deleted ", "delete");
    return $response->write(json_encode($executeQry));
});

?>
