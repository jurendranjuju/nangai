<link href="https://fonts.googleapis.com/css2?family=Arsenal&family=Noto+Sans+JP&display=swap" rel="stylesheet"><style>

.overlay {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #231f20;
  overflow-x: hidden;
}

.overlay-content {
  position: relative;
  top: 25%;
  width: 100%;
  text-align: left;
}

.overlay a {
  padding: 8px;
  /* text-decoration: none; */
  font-size: 36px;
  color: #fff;
  display: block;

}

.overlay a:hover, .overlay a:focus {
  color: #f1f1f1;
  text-decoration:underline;
    /* text-decoration: none;
    border-bottom: 10px solid white;
    width:150px;
    padding-top:-50vh; */
}

.overlay .closebtn {
  position: absolute;
  top: 20px;
  right: 45px;
  font-size: 60px;
}

@media screen and (max-height: 450px) {
  .overlay a {font-size: 20px}
  .overlay .closebtn {
  font-size: 40px;
  top: 15px;
  right: 35px;
  }
}

@media only screen and (min-width: 1080px) and (max-width: 1920px) {
	.menu-custom-img{
    width: 750px!important;
    height: 900px!important;
    margin-top: -80px!important;
  }
  .custm-hght{
    line-height: 6rem!important;
    margin-top: -50px!important;
    margin-left: 20%!important;

  }
}

@media only screen and (min-width: 900px) and (max-width: 1440px) {
  .menu-custom-img{
    width: 570px!important;
    height: 700px!important;
    margin-top: -50px!important;
  }
  .custm-hght{
    line-height: 5rem!important;
    margin-top: -20px!important;
    margin-left: 20%!important;

  }
}

@media only screen and (min-width: 800px) and (max-width: 1280px) {
  .menu-custom-img{
    width: 500px!important;
    height: 600px!important;
    margin-top: -20px!important;
  }
  .custm-hght{
    line-height: 5rem!important;
    margin-top: -20px!important;
    margin-left: 20%!important;

  }
}

@media only screen and (min-width: 768px) and (max-width: 1366px) {
  .menu-custom-img{
    width: 500px!important;
    height: 600px!important;
    margin-top: -20px!important;
  }
  .custm-hght{
    line-height: 5rem!important;
    margin-top: -20px!important;
    margin-left: 25%!important;

  }
}

@media only screen and (min-width: 360px) and (max-width: 640px) {
  .menu-custom-img{
    display:none!important;
  }
  .custm-hght{
    line-height: 3rem!important;
    margin-top: 0px!important;
    margin-left: 20%!important;

  }

}
</style>

<nav class="navbar navbar-expand-lg white">

    <div id="myNav" class="overlay">
                <div class="px-5 py-2 row white d-none d-sm-block d-md-block">
                      <div  style="display:inline!important;"><img src="{{ asset('img/vlogo.png') }}" class="py-0" style="height:60px"></div>
                      <div style="display:inline!important;float:right!important"><img href="javascript:void(0)" onclick="closeNav()" src="{{ asset('img/menu-brown.png') }}" class="mt-3" style="width:35px;height:35px;"></div>
                </div>
                <div class="row white d-block d-sm-none d-md-none px-4" style="padding:15px;">
                      <img src="img/vlogo.png" class="py-0" style="display:inline!important;height:60px">
                      <img src="img/menu-brown.png" href="javascript:void(0)" onclick="closeNav()" style="margin-right:10px;margin-top:5px;float:right;display:inline!important;width:35px;height:35px;">
                </div>
            <div class="overlay-content">
                <div class="row">
                      <div class="col-md-2"></div>
                      <div class="col-md-5" style="margin-top: -6rem !important;">
                          <p class="custm-hght" style="font-family: 'Arsenal', sans-serif;"><a href="/">HOME</a>
                          <a href="/portfolio">PORTFOLIO</a>
                          <a href="/blog">BLOG</a>
                          <a href="/career">JOIN</a>
                          <a href="/contact">CONTACT</a></p>
                      </div>
                      <div class="col-md-5" style="margin-top: -9.5rem !important;">
                        <img class="menu-custom-img" src="{{ asset('img/menu-img.png') }}" style="width:500px;height:500px;">
                      </div>
                </div>
            </div>
    </div>

    <a class="navbar-brand pl-n2 d-block d-sm-none d-md-none" href="index.php"><img src="{{ asset('img/vlogo.png') }}" class="py-0"  style="height:60px"></a>
    <a class="navbar-brand pl-4 d-none d-sm-block d-md-block" href="index.php"><img src="{{ asset('img/vlogo.png') }}" class="py-0"  style="height:60px"></a>
    <img class="ml-auto mr-2 d-block d-sm-none d-md-none" src="{{ asset('img/menu.png') }}" onclick="openNav()" style="width:50px;height:50px;">
    <img class="ml-auto mr-5 d-none d-sm-block d-md-block" src="{{ asset('img/menu.png') }}" onclick="openNav()" style="width:50px;height:50px;">

</nav>


<script>
function openNav() {
  document.getElementById("myNav").style.width = "100%";
}

function closeNav() {
  document.getElementById("myNav").style.width = "0%";
}
</script>