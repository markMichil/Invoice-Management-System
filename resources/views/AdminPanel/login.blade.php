@include('AdminPanel.layouts.header')

<div class="login-page">
    <div class="login-box">
        <div class="login-logo" style="margin-bottom: 50px">
            <span>
                <img style=" background-size:100px;border-radius: 5px; " src="https://www.loadserv.com.eg/usersfile/images/brand-logo.png"></span>

            <br>
            <a href="#"><b>LOGIN HERE </b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <form action="{{route('adminLogin')}}" method="POST">
                    @include('AdminPanel.layouts.messages')
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email"  class="form-control" placeholder="Email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block text-center">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</div>


@include('AdminPanel.layouts.footer')
