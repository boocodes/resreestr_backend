
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1 >API interface</h1>
    <h2 style="margin-bottom: 30px">User</h2>
    <ul style="font-size: 25px">
        <li >
            <b style="color: green">edit_user.php</b> - edit user fields  <span style="color: orange">(POST)</span> - <span style="color: red">not work!!</span>
        </li>
        <li>
            <b style="color: green">get_user_page_by_login</b> - get public user`s value, need to search and learn user`s profile <span style="color: orange">(POST)</span>
        </li>
        <li>
            <b style="color: green">login</b> - need to login user and get access <span style="color: orange">(POST)</span>
        </li>
        <li>
            <b style="color: green">registration</b> - need to insert a new user data into database <span style="color: orange">(POST)</span>
        </li>
        <li>
            <b style="color: green">update_user_avatar</b> - need to upload and update user`s avatar image <span style="color: orange">(POST)</span>
        </li>
        <li>
            <b style="color: green">update_user_fields</b> - edit user`s fields <span style="color: orange">(POST)</span>
        </li>
        <li>
            <b style="color: green">user_data</b> - <span style="color: red">not active</span> <span style="color: orange">(POST)</span>
        </li>
    </ul>
    <h2 style="margin-bottom: 30px">Container</h2>
    <ul style="font-size: 25px">
        <li>
            <b style="color: green">create_contain</b> - uses to create new container (repository) <span style="color: orange">(POST)</span>
        </li>
        <li>
            <b style="color: green">get_contain_by_login</b> - need to get public or opened container values <span style="color: orange">(POST)</span>
        </li>
        <li>
            <b style="color: green">get_self_contains</b> - uses to get personal contains list <span style="color: orange">(POST)</span>
        </li>
        <li>
            <b style="color: green">upload_contains_files</b> - need to upload contain files <span style="color: orange">(POST)</span> <span style="color: red">not working!!</span>
        </li>
    </ul>
</body>
</html>
