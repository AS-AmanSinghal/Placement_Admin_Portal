<section class="content">
    <div class="box box-primary add_company_form" style="<?=($result) ?"":'display:none'?>">
        <div class="box-header with-border">
            <h3 class="box-title">Add Company</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="<?=ADMIN_URL."company/index"?>">
            <div class="box-body">
                <div class="row">
                    <?= ($result) ? "<input hidden name='id' value='" . $result['id'] . "'>" : "" ?>
                </div>
            </div>
            <!-- /.box-body -->
        </form>
    </div>

    <section class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Company List</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="adv-table">
                <table class="table table-striped table-responsive" style="overflow-x: scroll" id="company_table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Company Name</th>
                        <th>Date of Drive</th>
                        <!--                        <th>Location</th>-->
                        <th>Pay Package</th>
                    </tr>
                    </thead>
                    <thead>
                    <tr>
                        <!--                            <th><input></th>-->
                        <!--                        <th><input></th>-->
                        <th><input></th>
                        <th><input></th>
                        <th><input></th>
                        <th><input></th>
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
        $('#company_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                'url': "<?= ADMIN_URL ?>company/ajax_previous_company_list",
                'method': 'post'
            }
        });
    });

    $(".add_company").click(function () {
        $(".add_company_form").show("slow");
    });
</script>