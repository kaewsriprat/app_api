<div class="container-xxl flex-grow-1 container-p-y">
    <!-- BREADCRUMB -->
    <h5 class="fw-bold pb-2 pt-4">
        <!-- home icon -->
        <a href="/home" class="text-muted fw-light">
            <i class="bx bx-home pb-1"></i>
        </a>
        / ผู้ใช้งาน
    </h5>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="row card-header">
                    <div class="col-6 h4 fw-bold">
                        บัญชีผู้ใช้งาน
                    </div>
                    <div class="col-6 text-end">
                        <a href="complaint_insert" class="btn btn-secondary btn-label-primary btn-sm me-2"><i class="bx bx-plus pe-2"></i>เพิ่มข้อมูล</a>
                    </div>
                </div>
                <div class="card-datatable text-nowrap">
                    <table class="datatables-ajax table table-bordered" id="usersTable">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>ชื่อ</th>
                                <th>นามสกุล</th>
                                <th>Email</th>
                                <th>สังกัด</th>
                                <th>สถานะ</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        initDataTable(<?php echo json_encode($data['users']) ?>);
    })

    function initDataTable(data) {

        //create columns from data
        var columns = [];
        for (var key in data[0]) {
            columns.push({
                data: key
            });
        }
        columns.splice(1, 1);

        $('#usersTable').DataTable({
            data: data,
            columns: columns
        });
    }
</script>