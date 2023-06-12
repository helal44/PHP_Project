<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <title>Document</title>
</head>
<body>
  

<div class="d-flex flex-wrap-column justify-content-center mt-7">
            <form class="form-inline" method="post" >
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search..." name="name" >
                <div class="input-group-append">
                <i class="fas fa-search text-white fs-1"></i>
                </div>
              </div>
            </form>
           

</div>
<hr>
</body>
</html> -->
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../../Public/Styles/Style.css">
  <title>Document</title>
  <style>
    .search-form {
      transform: scaleY(0);
      transform-origin: top;
      transition: transform 0.3s ease-in-out;
    }

    .search-form.active {
      transform: scaleY(1);
    }
    .div{
top:0;
z-index: 999;
     }
     i{
      display: inline-block;
      margin-top:0;
      margin-left: 0;
     }
  </style>
</head>
<body>
  <div class="d-flex flex-wrap-column justify-content-center div">
    <form class="form-inline" method="post">
      <div class="input-group-append icons">
        <i class="fas fa-search text-white fs-1 m-2" id="search-btn"></i>
      </div>
      <div class="input-group search-form">
        <input type="text" class="form-control" placeholder="Search..." name="name">
      </div>
    </form>
  </div>
  <hr>

  <script>
    const searchBtn = document.getElementById('search-btn');
    const searchForm = document.querySelector('.search-form');

    searchBtn.addEventListener('click', () => {
      searchForm.classList.toggle('active');
    });
  </script>
</body>
</html>
