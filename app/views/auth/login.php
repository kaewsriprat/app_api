<div class="d-flex justify-content-center mt-5">
    <div class="card">
        <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
                    <span class="app-brand-logo demo"></span>
                    <span class="app-brand-text demo text-body fw-bolder pb-2">เข้าสู่ระบบ</span>
                </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">สำหรับเจ้าหน้าที่</h4>
            <p class="mb-4"><?php echo APP_TITLE_TH; ?></p>

            <div class="row">
                <form class="form" action="/auth/login" method="POST">
                    <div class="col-12 mb-3">
                        <label for="emailInput" class="form-label">Username</label>
                        <input type="text" class="form-control" id="emailInput" name="emailInput" placeholder="Enter your email" autofocus>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="passwordInput">Password</label>
                        </div>
                        <div class="input-group input-group-merge">
                            <input type="password" id="passwordInput" class="form-control" name="passwordInput" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>

                    <!-- if error -->
                    <?php if (isset($data['error'])) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $data['error']; ?>
                        </div>
                    <?php endif; ?>

                    <div class="pt-4 mb-3 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary btn-lg" name="signin">เข้าสู่ระบบ</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>