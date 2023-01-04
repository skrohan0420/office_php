<div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                <h1 class="page-title mb-4">Subscriptions</h1>

                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Subscriptions list</div>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                            <thead class="tablred">
                                <tr>
                                    <th>#</th>
                                    <th>Device Id</th>
                                    <th>Owner Name </th>
                                    <th>Mobile Number</th>
                                    <th>Email</th>
                                    <th>Active Date</th>
                                    <th>Expire Date</th>
                                    <th>Amount </th>
                                    <th>Status</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php if(!empty($data)){?>
                                    <?php $i = 0;?>
                                    <?php foreach($data as $key => $val){ $i++?>
                                        <tr> 
                                            <td><?=  $i?></td>
                                            <td><?=  $data[$key]['device_id']?></td>
                                            <td><?=  $data[$key]['name']?></td>
                                            <td><?=  $data[$key]['phone_number']?></td>
                                            <td>
                                                <?= empty($data[$key]['email']) ? '-':  $data[$key]['email']?>
                                            </td>
                                            <td><?=  date('d/m/Y', strtotime($data[$key]['created_at'])) ?></td>
                                            <td><?=  date('d/m/Y', strtotime($data[$key]['expiry_date']))?></td>
                                            <td><?=  '₹ ' .  $data[$key]['price'] ?></td>
                                            <td class="<?=  $data[$key]['status'] == 'active' ? 'text-success':'text-danger' ?>">
                                                <?=  $data[$key]['status']?>
                                            </td>
                                        </tr>
                                    <?php }?>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>