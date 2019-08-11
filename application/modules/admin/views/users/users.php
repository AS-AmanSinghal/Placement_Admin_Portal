<section clas s="content">
    <div class="box box-primary add_student_form" style="<?= ($result) ? "" : 'display:none' ?>">
        <div class="box-header with-border">
            <h3 class="box-title">Add Student</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="<?= ADMIN_URL . "users/index" ?>">
            <?= (isset($result['users']['id'])) ? "<input hidden name='id' value='" . $result['users']['id'] . "'>" : "" ?>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Student Name</label>
                            <input type="text" class="form-control" required="" placeholder="Enter Name" name="name" value="<?= ($result) ? $result['users']["name"] : "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Email Id</label>
                            <input type="text" class="form-control" required="" placeholder="Enter Name" name="email"value="<?= ($result) ? $result['users']["email"] : "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Mobile Number</label>
                            <input type="text" class="form-control" required="" placeholder="Mobile Number" name="mobile" value="<?= ($result) ? $result['users']["mobile"] : "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" <?= (!$result) ? "required" : "" ?> placeholder="Enter Password" name="password">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Stream</label>
                            <input type="text" class="form-control" required="" placeholder="Enter Stream" name="stream" value="<?= ($result) ? $result['users']["stream"] : "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Skill</label>
                            <input type="text" class="form-control" required="" placeholder="Enter Skills" name="skills" value="<?= ($result) ? $result['users']["skills"] : "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Batch</label>
                            <input type="text" class="form-control" required="" placeholder="Enter Batch" name="batch" value="<?= ($result) ? $result['users']["batch"] : "" ?>">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <?php
                    if (isset($result['educational']) && $result['educational']) {
                        $count = 0;
                        foreach ($result['educational'] as $educ) {
                            if ($count == 0) {
                                ?>
                                <div class="add_multiple">
                                    <?php
                                } else if ($count == 1) {
                                    ?>
                                    <div class="clearfix">
                                        <?php
                                    }
                                    ?>
                                    <input type="number" name="edu_ids[]" value="<?= $educ['id'] ?>" hidden="">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Select Qualification</label>
                                            <select class="form-control" name="education_id[]">
                                                <option value="">Select</option>
                                                <?php
                                                if (isset($education) && $education) {
                                                    foreach ($education as $edu) {
                                                        ?>
                                                        <option <?= ($educ['education_id'] == $edu['id']) ? "SELECTED" : "" ?> value="<?= $edu['id'] ?>"><?= $edu['title'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Roll No</label>
                                            <input type="text" class="form-control" value="<?= $educ['roll_no'] ?>" required="" placeholder="Enter Roll No" name="roll_no[]">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Marks</label>
                                            <input type="text" class="form-control" value="<?= $educ['marks'] ?>" required="" placeholder="Enter Marks" name="marks[]">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Max Marks</label>
                                            <input type="text" class="form-control" value="<?= $educ['max_marks'] ?>" required="" placeholder="Enter Max Marks" name="max_marks[]">
                                        </div>
                                    </div>
                                    <?php
                                    if ($count == 0) {
                                        ?></div><?php
                                }
                                ++$count;
                            }
                        } else {
                            ?>

                        <div class="add_multiple">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Select Qualification</label>
                                    <select class="form-control" name="education_id[]">
                                        <option value="">Select</option>
                                        <?php
                                        if (isset($education) && $education) {
                                            foreach ($education as $edu) {
                                                ?>
                                                <option value="<?= $edu['id'] ?>"><?= $edu['title'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Roll No</label>
                                    <input type="text" class="form-control" required="" placeholder="Enter Roll No" name="roll_no[]">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Marks</label>
                                    <input type="text" class="form-control" required="" placeholder="Enter Marks" name="marks[]">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Max Marks</label>
                                    <input type="text" class="form-control" required="" placeholder="Enter Max Marks" name="max_marks[]">
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <?php
                    }
                    ?>
                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><?= ($result) ? "Update" : "Submit" ?></button>
                            <button type="button" class="btn btn-danger" onclick="$('.add_student_form').hide('slow')">Cancel</button>
                        </div>
                    </div>
                    <div class="col-md-4 pull-right">
                        <div class="form-group">
                            <button type="button" class="btn btn-primary pull-right add_more_btn">Add More</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </form>
    </div>

    <section class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Student List</h3><button class="btn btn-primary pull-right btn-xs add_student">Add Student</button>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="adv-table">
                <table class="table table-striped table-responsive" style="overflow-x: scroll" id="student_table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
<!--                            <th>Roll No</th>-->
                            <th>Appeared in</th>
                            <th>Stream</th>
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
<!--                            <th><input></th>-->
                            <th></th>
                            <th><input class="form-control input-sm search-input-text" data-column="1"></th>
                            <th><input class="form-control input-sm search-input-text" data-column="2"></th>
                            <th><input class="form-control input-sm search-input-text" data-column="3"></th>
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
        var table = "student_table";
        var dataTable = $("#" + table).DataTable({
            processing: true,
            pageLength: 10,
            serverSide: true,
            'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': [0, -1] /* 1st one, start by the right */
                }],
            order: [[0, "desc"]],
            ajax: {
                url: "<?= ADMIN_URL ?>users/ajax_student_list", // json datasource
                type: "post", // method  , by default get
                error: function () {  // error handling
                    $("." + table + "-error").html("");
                    $("#" + table + "_processing").css("display", "none");
                }
            }
        });
        $("#" + table + "_filter").css("display", "none");
        $('.search-input-text').on('keyup', function () {   // for text boxes
            var i = $(this).attr('data-column');  // getting column index
            var v = $(this).val();  // getting search input value
            dataTable.columns(i).search(v).draw();
        });
        $('.search-input-select').on('change', function () {   // for select box
            var i = $(this).attr('data-column');
            var v = $(this).val();
            dataTable.columns(i).search(v).draw();
        });
    });

    $(".add_student").click(function () {
        $(".add_student_form input").val();
        $(".add_student_form").show("slow");
    });

    $(".add_more_btn").click(function () {
        var html = $(".add_multiple").children().clone();
        html.find("input").val("");
        html.find("select").val("");
        $(".add_multiple").next().append(html);
    });
</script>
