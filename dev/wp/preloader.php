<?php
//* put these in index.php
#ob_start();include_once __DIR__ . '/preloader.php';
#ob_end_flush(); 

// set a page "loading" message... cleanup onload (see script below)
echo '<p
   id="loader" 
   style="
      position: fixed; overflow: hidden; z-index: 2400;
      bottom: calc(35dvh + 1rem); width: 100%;
      margin: auto; padding: 1em 1em;
      background-color: #ffffffc0;
      text-align: center; color: red; font-family: sans-serif;
      transition: all 2s linear;
      "
   >
   Loading page ...
   </p>';

?>

<script language="javascript">
   window.onload = (event) => {
      document.getElementById("loader").remove();
      console.log("page is fully loaded");
   };
</script>