<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Login Page!</h1>
                                </div>
                                <?= $this->session->flashdata('pesan'); ?>
                                <form class="user" action="" method="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="email" placeholder="Enter Email Address..." name="email" value="<?= $email ?>">
                                        <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" placeholder="Password" name="password">
                                        <?php echo form_error('password', '<small class="text-danger pl-3">', '</small>') . '<br>'; ?>
                                        <i class="fa fa-eye pl-3 " id="eye" aria-hidden="true"></i>
                                        <i class="fa fa-eye-slash pl-3 text-danger d-none" id="eye-slash" aria-hidden="true"></i>
                                        <small id="see">Tampilkan Password</small>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url(); ?>auth/register">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script>
    $(document).ready(function() {
        $('#eye').on("click", function() {
            $('#eye').toggleClass("d-none");
            $('#eye-slash').toggleClass("d-none");
            $('#password').attr('type', 'text');
            $('#see').html('Sembunyikan Password');
        });
        $('#eye-slash').on("click", function() {
            $('#eye').toggleClass("d-none");
            $('#eye-slash').toggleClass("d-none");
            $('#password').attr('type', 'password');
            $('#see').html('Tampilkan Password');
        });
    });
</script>