<?php
require_once("config.php");

$mess = new Message();
$errors = [];
if (!empty($_POST)) {
    $validator = new Validator(new DB());
    foreach ($_POST as $k => $v) {
        $validator->checkEmpty($k, $v);
        if ($k == 'email') {
            $validator->checkEmail($v);
        }
    }
    $errors = $validator->errors;
    if (empty($errors)) {
        $mess->message = $_POST['message'];
        $mess->name = $_POST['name'];
        $mess->email = $_POST['email'];
        $mess->save();
    }
}
$messages = $mess->findAll();
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Guest Book</title>
    <style>
        #comments-header {
            text-align: center;
        }

        #comments-form {
            border: 1px dotted black;
            width: 50%;
            padding-left: 20px;
        }

        #comments-form textarea {
            width: 70%;
            min-height: 100px;
        }

        #comments-panel {
            border: 1px dashed black;
            width: 50%;
            padding-left: 20px;
            margin-top: 20px;
        }

        .comment-date {
            font-style: italic
        }
    </style>
</head>
<body>
<div id="comments-header">
    <h1>Гостевая книга</h1>
</div>
<div id="comments-form">
    <h3>Введите ваше сообщение</h3>
    <form method="POST">
        <div style="color: red;">
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
        <div>
            <label>Имя:</label>
            <div>
                <input type="text" name="name" value=""/>
            </div>
        </div>
        <div>
            <label>Email:</label>
            <div>
                <input type="text" name="email" value=""/>
            </div>
        </div>
        <div>
            <label>Сообщение</label>
            <div>
                <textarea name="message"></textarea>
            </div>
        </div>
        <div>
            <br>
            <input type="submit" name="submit" value="Отправить">
        </div>
    </form>
</div>
<div id="comments-panel">
    <h3>Сообщения:</h3>
    <?php foreach ($messages as $message) : ?>
        <p>

            <b><?= $message['name'] ?> - <?= $message['email'] ?></b>
            <span class="comment-date">
                (<?= $message['created_at'] ?>)
            </span>
            <br>
            <?= $message['message']; ?></p>
    <?php endforeach; ?>
</div>
</body>
</html>