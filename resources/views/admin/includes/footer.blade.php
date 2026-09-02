        <!-- Page Footer -->
        <div class="hk-footer">
            <footer class="container-fluid footer px-5">
                <div class="row">
                    <div class="col-xl-12">
                        <p class="footer-text text-center"><span class="copy-text text-center">ElevateX © {{ date('Y') }} All rights reserved.</span>
                        </p>
                    </div>
                    <!-- <div class="col-xl-4">
                    </div> -->
                </div>
            </footer>
        </div>
        <!-- / Page Footer -->

    </div>
    <!-- /Main Content -->
</div>


<!-- jQuery -->

<script src="{{ asset('admin/js/jquery.min.js') }}"></script>


<!-- Bootstrap Core JS -->
<script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('admin/js/feather.min.js') }}"></script>

<!-- Fancy Dropdown JS -->
<script src="{{ asset('admin/js/dropdown-bootstrap-extended.js') }}"></script>

<!-- Simplebar JS -->
<script src="{{ asset('admin/js/simplebar.min.js') }}" ></script>

 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Data Table JS --> 
<!-- <script src="{{ asset('admin/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('admin/js/dataTables.select.min.js') }}"></script> -->

<!-- Daterangepicker JS -->
<script src="{{ asset('admin/js/moment.min.js') }}"></script>
<script src="{{ asset('admin/js/daterangepicker.js') }}"></script>
<script src="{{ asset('admin/js/daterangepicker-data.js') }}"></script>

<script src="{{ asset('admin/js/init.js') }}"></script>
<script src="{{ asset('admin/js/bootstrap-datepicker.min.js') }}"></script>


<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});

function formattedDateTime(created_at_data){
                created_at = created_at_data;
                const d = new Date(created_at);

                var hours = d.getHours();
                var minutes = d.getMinutes();
                // var seconds = d.getSeconds();

                var formattedTime = formatTime(hours, minutes);
                console.log("Formatted Time: ", formattedTime);

                function formatTime(hours, minutes, seconds) {
                    // Format the time as HH:MM:SS
                    return (
                        leadingZero(hours) + ':' +
                        leadingZero(minutes)
                        // leadingZero(seconds)
                    );
                }

                function leadingZero(number) {
                    // Add a leading zero if the number is less than 10
                    return number < 10 ? '0' + number : number;
                }

                var dateFromResponse = new Date(created_at);
                var formattedDate = dateFromResponse.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
                data = formattedDate + " " +" "+ formattedTime;
                return data;
    }
    $(document).ready(function(){
        $(".msg-disappear-icon").click(function(){
            $("#error_section").fadeOut();
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

