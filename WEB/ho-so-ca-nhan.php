<?php
    $sql = "SELECT * FROM USER WHERE ID = '{$user_id}'";
    $user_info = getOne($connect, $sql);
?>

<h2 class="mt-2 text-success">Hồ sơ cá nhân</h2>
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 pl-0">
            <img class="" src="image/avatar-default.png" alt="" width="300" height="300" style="border: 1px solid black; border-radius: 5px;"> 
        </div>
        <div class="col-sm-3 pl-0">
             <div class="bg-primary p-2" style="border-radius: 5px;">
                <h4 class="text-white"><?= $user_info['fullname']?></h4>
                <p class="text-dark"><b><?= ucfirst($user_info['user_type'])?></b></p>
             </div>
             <h5 class="mt-2">SĐT: <?= $user_info['phone_number']?></h5>
             <h5 class="mt-2">Email: <?= $user_info['email']?></h5>
             <h5 class="mt-2">Địa chỉ: <?= $user_info['address']?></h5>
             <h5 class="mt-2">Trạng thái: <?= ucfirst($user_info['status'])?></h5>
        </div>
    </div>
</div>