<?php
require('config.php');
require('app.php');
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <title>鐵達尼號旅客名單查詢</title>
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-6">
    <h3>鐵達尼號旅客名單查詢</h3>
    <form action="/" method="POST">
      <div class="form-group">
        <label for="sql_query">請輸入查詢語法</label>
        <textarea class="form-control" id="sql_query" name="sql_query" rows="3" placeholder="SELECT * FROM `titanic` WHERE `Survived` = 1 AND `Sex` = 'male'"></textarea>
      </div>
      <button type="submit" class="btn btn-primary my-2">查詢</button>
    </form>
    </div>
  </div>
  <?php if (isset($sql_error)): ?>
  <div class="row">
    <div class="alert alert-danger" role="alert">
      <h4 class="alert-heading">錯誤</h4>
      <p><?= $sql_error ?></p>
    </div>
  </div>
  <?php endif ?>
</div>
<?php if (isset($result)): ?>
<div class="container-fluid">
  <div class="row">
    <div class="col">
      <?= '總計 '.count($result).' 筆資料' ?>
      <?= $file ? '<a href="./QueryOutput.txt">下載</a>' : ''; ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">旅客ID</th>
            <th scope="col">存活與否</th>
            <th scope="col">票務艙</th>
            <th scope="col">姓名</th>
            <th scope="col">性別</th>
            <th scope="col">年齡</th>
            <th scope="col">兄弟姊妹配偶人數</th>
            <th scope="col">父母子女人數</th>
            <th scope="col">船票號碼</th>
            <th scope="col">票價</th>
            <th scope="col">船艙號碼</th>
            <th scope="col">登船港口</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($result as $passenger): ?>
          <tr>
            <th scope="row"><?= $passenger['PassengerId'] ?></th>
            <td><?= $passenger['Survived'] ?></td>
            <td><?= $passenger['Pclass'] ?></td>
            <td><?= $passenger['Name'] ?></td>
            <td><?= $passenger['Sex'] ?></td>
            <td><?= $passenger['Age'] ?></td>
            <td><?= $passenger['SibSp'] ?></td>
            <td><?= $passenger['Parch'] ?></td>
            <td><?= $passenger['Ticket'] ?></td>
            <td><?= $passenger['Fare'] ?></td>
            <td><?= $passenger['Cabin'] ?></td>
            <td><?= $passenger['Embarked'] ?></td>
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php endif ?>
</body>
</html>