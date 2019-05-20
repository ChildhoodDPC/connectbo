<?php
/**
 * Returns the list of cars.
 */
require "../dbconnectbo.php";
if(isset($_GET['cheepid'])){
  $cheep_id = $_GET['cheepid'];
  $query = "delete from cheeps where cheep_id = '$cheep_id' ";
  $result = mysqli_query($db,$query);
  if ($result) { http_response_code(204); }
  else { return http_response_code(422); }
}
else{
$cheeps = [];
$sql = "SELECT cheeps.cheep_id, users.username, cheeps.cheep_text, cheeps.created_date FROM cheeps,users where cheeps.user_id = users.user_id";
if($result = mysqli_query($db,$sql))
{
  $cr = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $cheeps[$cr]['id']    = $row['cheep_id'];
    $cheeps[$cr]['text'] = $row['cheep_text'];
    $cheeps[$cr]['date'] = $row['created_date'];
    $cheeps[$cr]['username'] = $row['username'];
    $cr++;
  }
    
  echo json_encode(['data'=>$cheeps]);
}
else
{
  http_response_code(404);
}
}