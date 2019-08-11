<section class="content">
    <div class="box box-primary add_education_form" style="<?= ($result) ? "" : 'display: none' ?>">
        <div class="box-header with-border">
            <h3 class="box-title">Add Student</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="<?=ADMIN_URL.'education/index'?>">
            <div class="box-body">
                <div class="row">
                    <?= ($result) ? "<input hidden name='id' value='" . $result['id'] . "'>" : "" ?>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Education Title</label>
                                <input type="text" class="form-control" required="" placeholder="Enter Education Title" name="title" value="<?= ($result) ? $result['title'] : "" ?>">
                            </div>
                        </div>
                    <div class="clearfix"></div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><?= ($result) ? "Update" : "Submit" ?></button>
                            <button type="button" class="btn btn-danger" onclick="$('.add_education_form').hide('slow')">Cancel</button>
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
            <h3 class="box-title">Education Title List</h3><button class="btn btn-primary pull-right btn-xs add_education">Add Education Title</button>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="adv-table">
                <table class="table table-striped table-responsive" style="overflow-x: scroll" id="education_table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <thead>
                    <tr>

                        <th><input></th>
                        <th><input></th>
                        <th></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

    </section>
</section>
<script>
    $(document).ready(function () {
        $('#education_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                'url': "<?= ADMIN_URL ?>education/ajax_education_list",
                'method': 'post'
            }
        });
    });

    $(".add_education").click(function () {
        $(".add_education_form").show("slow");
    });
</script>