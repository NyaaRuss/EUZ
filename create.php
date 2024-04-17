<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>EUZ</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/navbar-fixed/">

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link href="css/stylesheet.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      body {
      /*background-image: url("img/logo.jpg");*/
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      margin: 0;
      padding: 0;
      height: 100vh;
      }
    </style>
    <!--{% include 'script.html' %}-->
    <!-- Custom styles for this template -->

    
    
  </head>
  <body>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top " style="background-color: #0e3807;">
        <img src="img/sv.png" height="30px" width="30px" />
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
        <a class="nav-link" href="home.php">HOME</a>
        </li>
        
        <li class="nav-item">
        <a class="nav-link " href="index.php" tabindex="-1" aria-disabled="true">MEMBERSHIP</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="create.php">NEW MEMBER</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pastmembers.php">PAST MEMBER</a>
        </li>
        
        
        <li class="nav-item">
        <a class="nav-link" href="logout.php">LOG OUT</a>
        </li>
    </ul>
    <!--<form class="form-inline mt-2 mt-md-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>-->
    </div>
    </nav>
 
  <div class="jumbotron">
    
  <h1 style="color:#144a0b; text-align: center; font-size: 50px; font-weight: bolder; font-family: helvetica; text-shadow: 6px 6px 6px #dcf4da;">Add New Member</h1>
    <br>
    <header class="d-flex justify-content-between my-4">
            <div>
            <a href="index.php" class="btn btn-outline-secondary">Back</a>
            </div>
        </header>

<div style="display: flex; justify-content: center;">
    <div style="display: flex; flex-direction: column; justify-content: space-between;">
        <ul class="list-group list-group-flush">

        <div class="card border-success mb-3" style="max-width: 30rem; margin-top: 50px;">
        <div class="card-header bg-success text-white">Add Member</div>
        <div class="card-body">
        
        <form action="process.php" method="post">
            
                <div class="input-group mb-3" >
                    <span class="input-group-text" id="basic-addon1">SURNAME</span>
                    <input type="text" class="form-control" name="Surname"  placeholder="Enter Member's Surname"  aria-label="Surname" required >
                </div>   

                <div class="input-group mb-3" >
                    <span class="input-group-text" id="basic-addon1">First_name</span>
                    <input type="text" class="form-control" name="First_name"  placeholder="Enter Member's First_name"  aria-label="First_name" required >
                </div> 
                <div class="input-group mb-3" >
                    <span class="input-group-text" id="basic-addon1">EmpNo</span>
                    <input type="text" class="form-control" name="EmpNo"  placeholder="Enter Member's EmpNo"  aria-label="EmpNo" required >
                </div> 
                <div class="input-group mb-3" >
                    <span class="input-group-text" id="basic-addon1">NatRegNo</span>
                    <input type="text" class="form-control" name="NatRegNo"  placeholder="Enter Member's NatRegNo"  aria-label="NatRegNo" required >
                </div> 
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">PROVINCE</span>
                    <select name="Province" id="province-select" class="form-control" required>
                        <option value="">Select Member Province</option>
                        <option value="HARARE">HARARE</option>
                        <option value="MAT SOUTH">MAT SOUTH</option>
                        <option value="MAT NORTH">MAT NORTH</option>
                        <option value="MASH EAST">MASH EAST</option>
                        <option value="MASH WEST">MASH WEST</option>
                        <option value="MANICALAND">MANICALAND</option>
                        <option value="MIDLANDS">MIDLANDS</option>
                        <option value="MASVINGO">MASVINGO</option>
                        <option value="MASH CENTRAL">MASH CENTRAL</option>
                        <option value="BULAWAYO">BULAWAYO</option>
                    </select>
                    </div>

                    <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">DISTRICT</span>
                    <select name="Descriptions" id="district-select" class="form-control" required>
                        <option value="">Select Member District</option>
                        <option value="HIGHGLEN" data-province="HARARE">HIGHGLEN</option>
                        <option value="GLENVIEW/MUFAKOSE" data-province="HARARE">GLENVIEW/MUFAKOSE</option>
                        <option value="MBARE/HATFIELD" data-province="HARARE">MBARE/HATFIELD</option>
                        <option value="WARREN PARK MABELREIGN" data-province="HARARE">WARREN PARK MABELREIGN</option>
                        <option value="NOTHERN CENTRAL" data-province="HARARE">NOTHERN CENTRAL</option>
                        <option value="CHITUNGWIZA" data-province="HARARE">CHITUNGWIZA</option>
                        <option value="EPMAFARA" data-province="HARARE">EPMAFARA</option>
                        <option value="REIGATE" data-province="HARARE">REIGATE</option>
                        
                        <option value="GOROMONZI" data-province="MASH EAST">GOROMONZI</option>
                        <option value="SEKE" data-province="MASH EAST">SEKE</option>
                        <option value="HWEDZA" data-province="MASH EAST">HWEDZA</option>
                        <option value="MARONDERA" data-province="MASH EAST">MARONDERA</option>
                        <option value="MUREHWA" data-province="MASH EAST">MUREHWA</option>
                        <option value="MUDZI" data-province="MASH EAST">MUDZI</option>
                        <option value="MUTOKO" data-province="MASH EAST">MUTOKO</option>
                        <option value="UMP" data-province="MASH EAST">UMP</option>
                        <option value="CHIKOMBA" data-province="MASH EAST">CHIKOMBA</option>

                        <option value="SANYATI" data-province="MASH WEST">SANYATI</option>
                        <option value="CHEGUTU" data-province="MASH WEST">CHEGUTU</option>
                        <option value="ZVIMBA" data-province="MASH WEST">ZVIMBA</option>
                        <option value="MAKONDE" data-province="MASH WEST">MAKONDE</option>
                        <option value="HURUNGWE" data-province="MASH WEST">HURUNGWE</option>
                        <option value="KARIBA" data-province="MASH WEST">KARIBA</option>
                        <option value="MHONDORO-NGEZI" data-province="MASH WEST">MHONDORO-NGEZI</option>

                        <option value="BINDURA" data-province="MASH CENTRAL">BINDURA</option>
                        <option value="MAZOWE" data-province="MASH CENTRAL">MAZOWE</option>
                        <option value="MT DARWIN" data-province="MASH CENTRAL">MT DARWIN</option>
                        <option value="MBIRE" data-province="MASH CENTRAL">MBIRE</option>
                        <option value="MUZARABANI" data-province="MASH CENTRAL">MUZARABANI</option>
                        <option value="RUSHINGA" data-province="MASH CENTRAL">RUSHINGA</option>
                        <option value="SHAMVA" data-province="MASH CENTRAL">SHAMVA</option>
                        <option value="GURUVE" data-province="MASH CENTRAL">GURUVE</option>


                        <option value="MUTARE CENTRAL" data-province="MANICALAND">MUTARE CENTRAL</option>
                        <option value="MAKONI" data-province="MANICALAND">MAKONI</option>
                        <option value="MUTASA" data-province="MANICALAND">MUTASA</option>
                        <option value="CHIPINGE" data-province="MANICALAND">CHIPINGE</option>
                        <option value="BUHERA" data-province="MANICALAND">BUHERA</option>
                        <option value="NYANGA" data-province="MANICALAND">NYANGA</option>
                        <option value="CHIMANIMANI" data-province="MANICALAND">CHIMANIMANI</option>

                        <option value="BUBI" data-province="MAT NORTH">BUBI</option>
                        <option value="BINGA" data-province="MAT NORTH">BINGA</option>
                        <option value="HWANGE" data-province="MAT NORTH">HWANGE</option>
                        <option value="LUPANE" data-province="MAT NORTH">LUPANE</option>
                        <option value="NKAYI" data-province="MAT NORTH">NKAYI</option>
                        <option value="TSHOLOTSHO" data-province="MAT NORTH">TSHOLOTSHO</option>
                        <option value="UMGUZA" data-province="MAT NORTH">UMGUZA</option>

                        <option value="BEITBRIDGE" data-province="MAT SOUTH">BEITBRIDGE</option>
                        <option value="BULILIMA" data-province="MAT SOUTH">BULILIMA</option>
                        <option value="GWANDA" data-province="MAT SOUTH">GWANDA</option>
                        <option value="INSIZA" data-province="MAT SOUTH">INSIZA</option>
                        <option value="MATOBO" data-province="MAT SOUTH">MATOBO</option>
                        <option value="UMZINGWANE" data-province="MAT SOUTH">UMZINGWANE</option>
                        <option value="MANGWE" data-province="MAT SOUTH">MANGWE</option>

                        <option value="GWERU" data-province="MIDLANDS">GWERU</option>
                        <option value="KWEKWE" data-province="MIDLANDS">KWEKWE</option>
                        <option value="GOKWE NORTH" data-province="MIDLANDS">GOKWE NORTH</option>
                        <option value="GOKWE SOUTH" data-province="MIDLANDS">GOKWE SOUTH</option>
                        <option value="MBERENGWA" data-province="MIDLANDS">MBERENGWA</option>
                        <option value="ZVISHAVANE" data-province="MIDLANDS">ZVISHAVANE</option>
                        <option value="SHURUGWI" data-province="MIDLANDS">SHURUGWI</option>
                        <option value="CHIRUMANZU" data-province="MIDLANDS">CHIRUMANZU</option>

                        <option value="MASVINGO CENTRAL" data-province="MASVINGO">MASVINGO CENTRAL</option>
                        <option value="GUTU" data-province="MASVINGO">GUTU</option>
                        <option value="CHIVI" data-province="MASVINGO">CHIVI</option>
                        <option value="BIKITA" data-province="MASVINGO">BIKITA</option>
                        <option value="CHIREDZI" data-province="MASVINGO">CHIREDZI</option>
                        <option value="MWENEZI" data-province="MASVINGO">MWENEZI</option>
                        <option value="ZAKA" data-province="MASVINGO">ZAKA</option>

                        <option value="MZILIKAZI" data-province="BULAWAYO">MZILIKAZI</option>
                        <option value="REIGATE" data-province="BULAWAYO">REIGATE</option>
                        <option value="IMBIZO" data-province="BULAWAYO">IMBIZO</option>
                        <option value="BULAWAYO CENTRAL" data-province="BULAWAYO">BULAWAYO CENTRAL</option>
                        <option value="KHAMI" data-province="BULAWAYO">KHAMI</option>
                        
                    </select>
                    </div>

                    <script>
                    // Get the select elements
                    const provinceSelect = document.getElementById('province-select');
                    const districtSelect = document.getElementById('district-select');

                    // Add an event listener to the province select
                    provinceSelect.addEventListener('change', function () {
                        const selectedProvince = provinceSelect.value;
                        
                        // Hide all options in the district select
                        Array.from(districtSelect.options).forEach(function (option) {
                        option.style.display = 'none';
                        });
                        
                        // Show only the options matching the selected province
                        Array.from(districtSelect.options).forEach(function (option) {
                        if (option.dataset.province === selectedProvince || option.value === '') {
                            option.style.display = 'block';
                        }
                        });
                        
                        // Reset the selected district
                        districtSelect.value = '';
                    });
                    </script>
                <div class="input-group mb-3" >
                    <span class="input-group-text" id="basic-addon1">DOB</span>
                    <input type="date" class="form-control" name="DOB"  placeholder="Enter Member's DOB"  aria-label="DOB" required >
                </div> 
                <div class="input-group mb-3" >
                    <span class="input-group-text" id="basic-addon1">APP DATE</span>
                    <input type="date" class="form-control" name="AppDate"  placeholder="Enter Member's AppDate"  aria-label="AppDate" required >
                </div> 
                <div class="input-group mb-3" >
                    <span class="input-group-text" id="basic-addon1">STATION DESCRIPTION</span>
                    <input type="text" class="form-control" name="StationDescription"  placeholder="Enter Member's StationDescription"  aria-label="StationDescription" required >
                </div> 
                
                <div class="input-group mb-3" >
                    <span class="input-group-text" id="basic-addon1">Department</span>
                    <input type="text" class="form-control" name="Department"  placeholder="Enter Member's Department"  aria-label="Department" required >
                </div> 
                <div class="input-group mb-3" >
                    <span class="input-group-text" id="basic-addon1">STAT CODE</span>
                    <input type="text" class="form-control" name="Statcode"  placeholder="Enter Member's Statcode"  aria-label="Statcode" required >
                </div> 
                
            
            <div class="form-element my-4">
                <input type="submit" name="create" value="Add Member" class="btn btn-success">
            </div>
        </form>
        </ul>  
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>