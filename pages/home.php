<script>
    $(document).ready(function() {

        function updateData() {
            $.ajax({
                url: "<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . '/api/get_data.php'; ?>",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    $('.suhu_val').html(response.temp + '&deg;C');
                    $('.kelembapan_val').html(response.humidity + ' %');                  
                },
                error: function(error) {
                    console.error("Error fetching data: ", error);
                }
            })
        }
        setInterval(updateData, 1000);
    });
</script>

<div class="row">
    <div class="col-md-6">
        <div class="card-home">
            <h4>Temperature</h4>
            <div class="circle-display suhu">
                <div class="suhu_val">
                    0&deg;C
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-6">
        <div class="card-home">
            <h4>Humidity</h4>
            <div class="circle-display kelembapan">
                <div class="kelembapan_val">
                    0 %
                </div>
            </div>
        </div>

    </div>
</div>