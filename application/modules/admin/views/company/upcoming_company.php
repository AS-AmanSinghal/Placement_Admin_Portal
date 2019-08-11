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
<!--                    <th>Action</th>-->
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
<!--                    <th></th>-->
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
                'url': "<?= ADMIN_URL ?>company/ajax_upcoming_company_list",
                'method': 'post'
            }
        });
    });
</script>