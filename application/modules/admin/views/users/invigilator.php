<section class="content">
    <div class="box box-primary add_invigilator_form" style="<?= ($result) ? "" : 'display: none' ?>">
        <div class="box-header with-border">
            <h3 class="box-title">Add Invigilator</h3>
        </div>
        <form role="form" method="post" action="<?=ADMIN_URL."users/invigilator"?>">
            <div class="box-body">
                <div class="row">
                    <?= ($result) ? "<input hidden name='id' value='" . $result['users']['id'] . "'>" : "" ?>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" required="" placeholder="Enter Name" name="name" value="<?= ($result) ? $result['users']['name'] : "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Email Id</label>
                            <input type="text" class="form-control" required="" placeholder="Enter Name" name="email" value="<?= ($result) ? $result['users']['email'] : "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Mobile Number</label>
                            <input type="text" class="form-control" required="" placeholder="Mobile Number" name="mobile"value="<?= ($result) ? $result['users']['mobile'] : "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" <?= ($result) ? "" : "required" ?> placeholder="Enter Password" name="password" value="<?= ($result) ? $result['users']['mobile'] : "" ?>">
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><?= ($result) ? "Update" : "Submit" ?></button>
                            <button type="button" class="btn btn-danger" onclick="$('.add_invigilator_form').hide('slow')">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </form>
    </div>

    <section class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Invigilator List</h3><button class="btn btn-primary pull-right btn-xs add_invigilator">Add Invigilator</button>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="adv-table">
                <table class="table table-striped table-responsive" style="overflow-x: scroll" id="invigilator_table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile Number</th>
                            <th>Action</th>
                            <!--                            <th>Batch</th>
                                                        <th>Aggregate % Graduation</th>
                                                        <th>Aggregate % PostGraduation</th>
                                                        <th>Total Aggregation%</th>
                                                        <th>10th Marks</th>
                                                        <th>12th Marks</th>
                                                        <th>Aggregate % Graduation</th>
                                                        <th>Aggregate % PostGraduation</th>
                                                        <th>Total Aggregation%</th>-->

                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th><input></th>
                            <th><input></th>
                            <th><input></th>
                            <th><input></th>
                            <th></th>
                            <!--                            <th><input></th>
                                                        <th><input></th>
                                                        <th><input></th>
                                                        <th><input></th>
                                                        <th><input></th>
                                                        <th><input></th>-->


                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </section>
</section>
<script>
    $(document).ready(function () {
        $('#invigilator_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                'url': "<?= ADMIN_URL ?>users/ajax_invigilator_list",
                'method': 'post'
            }
        });
    });

    $(".add_invigilator").click(function () {
        $(".add_invigilator_form").show("slow");
    });
</script>