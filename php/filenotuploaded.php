<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="card text-white bg-danger mb-3 mx-5 px-3 pt-2">
  <h5 class="card-header text-center">Error Found</h5>
  <div class="card-body">
    <p class="card-text">While trying to submit your CV or Resume, we have found some error.</p>
    <p class="card-text"><?php> echo "ERROR: Could not able to execute $sql. " . mysqli_error($con); ?></p>
    <p>Try again.</p>
  </div>
</div>
