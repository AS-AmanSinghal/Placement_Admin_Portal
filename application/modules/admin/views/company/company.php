<?php
if ($result) {
    $criteria = $result['criteria'];
    $result = $result['company'];
}
?>
<section class="content">
    <div class="box box-primary add_company_form" style="<?= ($result) ? "" : 'display:none' ?>">
        <div class="box-header with-border">
            <h3 class="box-title">Add Company</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">
            <div class="row">
                <form role="form" method="post" action="<?= ADMIN_URL . "company/index" ?>">
                    <?= ($result) ? "<input hidden name='id' value='" . $result['id'] . "'>" : "" ?>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" class="form-control" required="" placeholder="Enter Name" name="name" value="<?= ($result) ? $result["name"] : "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Stream Required</label>
                            <input type="text" class="form-control" required="" placeholder="Enter Stream Required" name="stream"value="<?= ($result) ? $result["stream"] : "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Batch</label>
                            <input type="text" class="form-control" required="" placeholder="Enter Batch" name="batch" value="<?= ($result) ? $result["batch"] : "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Designation</label>
                            <input type="text" class="form-control" required="" placeholder="Enter Designation" name="designation"value="<?= ($result) ? $result["designation"] : "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Skills Required</label>
                            <input type="text" class="form-control" required="" placeholder="Enter Skills Required" name="skills"value="<?= ($result) ? $result["skills"] : "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Date Of Drive</label>
                            <input type="date" class="form-control" required="" placeholder="Enter Date" name="drive_date" value="<?= ($result) ? date("Y-m-d", $result["drive_date"]) : "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Job Location</label>
                            <input type="text" id="autocomplete" onFocus="geolocate()" class="form-control" required="" placeholder="Enter Job Location" name="location"value="<?= ($result) ? $result["location"] : "" ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Pay Package</label>
                            <input type="text" class="form-control" required="" placeholder="Enter Pay Package" name="package"value="<?= ($result) ? $result["package"] : "" ?>">
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <?php
                    if (isset($criteria) && $criteria) {
                        $count = 0;
                        foreach ($criteria as $cri) {
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
                                    <input type="number" name="cri_id[]" value="<?= $cri['id'] ?>" hidden="">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Education</label>
                                            <select class="form-control" name="education_id[]">
                                                <option value="">Select Course</option>
                                                <?php
                                                if (isset($education) && $education) {
                                                    foreach ($education as $edu) {
                                                        ?>
                                                        <option <?= ($cri['education_id'] == $edu['id']) ? "SELECTED" : "" ?> value="<?= $edu['id'] ?>"><?= $edu['title'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Eligibilty Criteria</label>
                                            <input type="text" class="form-control" value="<?= $cri['criteria'] ?>" required="" placeholder="Eligibilty Criteria" name="roll_no[]">
                                        </div>
                                    </div>

                                    <?php
                                    if ($count == 0) {
                                        ?></div><?php
                                }
                                ++$count;
                            }
                            ?></div><?php
                        } else {
                            ?>

                        <div class="add_multiple">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Education</label>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Eligibilty Criteria</label>
                                    <input type="text" class="form-control" required="" placeholder="Eligibilty Criteria" name="criteria[]">
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
                            <button type="button" class="btn btn-danger" onclick="$('.add_company_form').hide('slow')">Cancel</button>
                        </div>
                    </div>
                    <div class="col-md-4 pull-right">
                        <div class="form-group">
                            <button type="button" class="btn btn-primary pull-right add_more_btn">Add More</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
        <section class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Company List</h3><button class="btn btn-primary pull-right btn-xs add_company">Add Company</button>
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
                                <th>Action</th>
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
        $('#company_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                'url': "<?= ADMIN_URL ?>company/ajax_company_list",
                'method': 'post'
            }
        });
    });

    $(".add_company").click(function () {
        $(".add_company_form").show("slow");
    });


    $(".add_more_btn").click(function () {
        var html = $(".add_multiple").children().clone();
        html.find("input").val("");
        html.find("select").val("");
        $(".add_multiple").next().append(html);
    });
</script>

<script>
    // This sample uses the Autocomplete widget to help the user select a
    // place, then it retrieves the address components associated with that
    // place, and then it populates the form fields with those details.
    // This sample requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script
    // src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    var placeSearch, autocomplete;

    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };

    function initAutocomplete() {
        // Create the autocomplete object, restricting the search predictions to
        // geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
                document.getElementById('autocomplete'), {types: ['geocode']});

        // Avoid paying for data that you don't need by restricting the set of
        // place fields that are returned to just the address components.
        autocomplete.setFields(['address_component']);

        // When the user selects an address from the drop-down, populate the
        // address fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details,
        // and then fill-in the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(addressType).value = val;
            }
        }
    }

    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle(
                        {center: geolocation, radius: position.coords.accuracy});
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCgblboWixNH0uEi3aADMxiUZoHQSirh2c&libraries=places&callback=initAutocomplete"
async defer></script>