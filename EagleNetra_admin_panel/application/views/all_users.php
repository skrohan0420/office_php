<div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                <h1 class="page-title mb-4">Users</h1>

                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Users List</div>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                            <thead class="tablred">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile Number</th>
                                    <th>Tracking for</th>
                                    <th>No. of Tracking Device</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php $i = 0;?>
                                <?php foreach($data as $key => $val){ $i++?>
                                    <tr> 
                                        <td><?=  $i?></td>
                                        <td><?=  $data[$key]['name']?></td>
                                        <td><?=  $data[$key]['email']?></td>
                                        <td><?=  $data[$key]['phone_number']?></td>
                                        <td><?=  $data[$key]['tracking_for'] ?></td>
                                        <td><?=  $data[$key]['total_devices']?></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>