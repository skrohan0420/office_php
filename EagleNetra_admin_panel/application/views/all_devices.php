<div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                <h1 class="page-title mb-4">Kids Tracking Device</h1>

                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Data Table</div>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                            <thead class="tablred">
                                <tr>
                                    <th>#</th>
                                    <th>Device Id</th>
                                    <th>Owner name</th>
                                    <th>Mobile Number</th>
                                    <th>Email</th>
                                    <th>Puchase Date</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php $i = 0;?>
                                <?php foreach($data as $key => $val){ $i++?>
                                    <tr>
                                        <td><?=  $i?></td>
                                        <td><?=  $data[$key]['device_id']?></td>
                                        <td><?=  $data[$key]['name']?></td>
                                        <td><?=  $data[$key]['card_number']?></td>
                                        <td><?=  $data[$key]['email'] ?></td>
                                        <td><?=  date('d/m/Y', strtotime($data[$key]['created_at'])) ?></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
           