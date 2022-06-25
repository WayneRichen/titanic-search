<?php
if (isset($_POST['sql_query']) && trim($_POST['sql_query'])!='' && str_contains($_POST['sql_query'], 'select')) {
  $sql = trim($_POST['sql_query']);
  try {
    $query = $conn->query($sql);
    $query->execute();
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $result = $query->fetchAll();
    $file = save_csv($result);
  } catch (PDOException $sql_error) {
    $sql_error = $sql_error->getMessage();
  }
}

function save_csv($result) {
  $delimiter = ',';
  $filename = "QueryOutput.txt";
  try {
    $f = fopen($filename, 'w');
    fputs($f, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
    $fields = array('PassengerId', 'Survived', 'Pclass', 'Name', 'Sex', 'Age', 'SibSp', 'Parch', 'Ticket', 'Fare', 'Cabin', 'Embarked');
    fputcsv($f, $fields, $delimiter);
    $fields = array('旅客ID', '存活與否', '票務艙', '姓名', '性別', '年齡', '兄弟姊妹配偶人數', '父母子女人數', '船票號碼', '票價', '船艙號碼', '登船港口');
    fputcsv($f, $fields, $delimiter);
  
    foreach ($result as $row_data) {
      $lineData = $row_data;
      fputcsv($f, $lineData, $delimiter); 
    }
    fclose($f);
    return true;
  } catch (\Throwable $th) {
    
  }
}