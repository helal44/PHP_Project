
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../../Public/Styles/Style.css">
  <title>Document</title>
 
</head>
<body>
  <div class="d-flex flex-wrap-column justify-content-center div">
    <form class="form-inline search-container" method="post">
      <div class="search-container">
      <div class="input-group-append icons">
        <i class="fas fa-search text-white fs-1 m-2" id="search-btn"></i>
      </div>
      <div class="input-group search-form">
        <input type="text" class="form-control" placeholder="Search..." name="name">
</div>
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
