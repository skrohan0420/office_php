        <!-- END SIDEBAR-->
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                <h1 class="page-title mb-4">Kids</h1>

                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Kids List</div>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                            <thead class="tablred">
                                <tr>
                                    <th>#</th>
                                    <th>Device Id</th>
                                    <th>Kid Name</th>
                                    <th>Smart Card Number</th>
                                    <th>Class</th>
                                    <th>Age</th>
                                    <th>Photo</th>
                                    <th>Manage by</th>
                                    <th>Emergency Contact</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php if(!empty($data)){?>
                                    <?php $i = 0?>
                                    <?php foreach($data as $key => $val){?>
                                        <tr>
                                            <td><?= $i += 1 ?></td>
                                            <td><?= $val['device_id']?></td>
                                            <td><?= $val['kid']?></td>
                                            <td><?= $val['card_number']?></td>
                                            <td><?= $val['class']?></td>
                                            <td><?= $val['age']?></td>
                                            <td>
                                                <img src="<?= base_url_api . $val['profile_image']?>" height="50px" width="50px"/>
                                            </td>
                                            <td><?= $val['parent']?></td>
                                            <td>
                                                <?php foreach($val['emergency_contact'] as $k => $v){ 

                                                   echo @$v['emergency_contact'] . '<br>';

                                                }?>
                                            </td>
                                        </tr>
                                    <?php }?>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                    <?php echo '<pre>';  print_r($data)?>
