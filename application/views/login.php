<?php
$title = "AgriExpress | User Login";
?>


<div class="banner-in">
  <div class="container">
    <h1>Login</h1>
    <ul class="newbreadcrumb">
      <li><a href="#">Home</a></li>
      <li>Login</li>
    </ul>
  </div>
</div>
<div id="main-container">
  <div class="container">

    <div class="row">
      <div class="col-sm-12 login-page" id="content">
        <div class="row">
          <div class="col-sm-4">
            <div class="well">
              <h4>NEW CUSTOMER</h4>
              <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
              <a class="btn btn-default btn-lg" href="<?=base_url('register')?>">Register</a>
            </div>
          </div>
          <div class="col-sm-8">
            <h4>RETURNING CUSTOMER</h4>
            <form name="loginForm" enctype="multipart/form-data" method="post" action="user_validation.php">
              <div class="form-group">
                <label for="input-email" class="control-label">Enter your Email Address</label>
                <input type="text" class="form-control" id="email"  name="email" vk_14c95="subscribed">
                <small class='error' for="email"></small>
              </div>
              <div class="form-group">
                <label for="input-password" class="control-label">Enter your Password</label>
                <input type="password" class="form-control" id="password"  name="password" vk_14c95="subscribed">
                <small class='error' for="password"></small>
              </div>
              <div class="clearfix">
                <input type="submit" class="btn btn-default btn-lg pull-left" value="Login">
                <a class="pull-right" href="#">Forgotten Password</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<?php if (isset($_SESSION['flash'])): ?>
  <script>
    var flashType = "<?php echo $_SESSION['flash']['type']; ?>";
    var flashMessage = "<?php echo $_SESSION['flash']['message']; ?>";
  </script>
  <?php unset($_SESSION['flash']); ?>
<?php endif; ?>
<style>
  .error {
    color: red;
    font-weight: bolder;
    font-family: Tahoma, sans-serif;
  }
</style>
<!-- Sweet Alert Script -->
<script>
  $(function() {
    if (typeof flashType !== 'undefined' && typeof flashMessage !== 'undefined') {
      Swal.fire({
        icon: flashType,
        title: flashMessage,
        showConfirmButton: true,
        timer: 3000
      });
    }
  });
</script>

<script src="javascript/jquery.validate.js"></script>
<!-- Validation Script -->
<script>
  $(function() {

    const validator = $("form[name='loginForm']").validate({
      rules: {
        email: {
          required: true,
          email: true,
        },
        password: {
          required: true,
        }

      },

      messages: {
        // for custom massage...
      },

      errorPlacement: function() {
        return false;
      },

      showErrors: function(errorMap, errorList) {
        $("small.error").html('');
        $('input.form-control').css({
          border: 'none',
          color: '#111'
        });
        for (let name in errorMap) {
          $(`small[for="${name}"]`).html(errorMap[name]);
          $(`input[id="${name}"]`).css({
            border: '1px solid red',
            color: 'red'
          });


        }
      },

      submitHandler: function(form) {
        form.submit();
      },

    })


  });
</script>
