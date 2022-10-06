<meta name="google-signin-scope" content="profile email">
<meta name="google-signin-client_id" content='212748848744-vr854thj6aem89gqt2l7nm9ahfprqt10.apps.googleusercontent.com'>

<script src="https://apis.google.com/js/platform.js?onload=init" async defer></script>


<style>
    <?php
    session_start();
    include_once 'css/navbarCss.css';
    ?>

</style>
<div class="navContainer">
	        <a href="openpage.php" class="first"><img style="height:125px; width:125px;" alt="travelify Logo" src="images/final_logo_nav.png" /></a>
	        <nav>
		        <ul>
                    <li><a href="map.php"><img alt="scratch map" src="images/map_nav.png" /> <p>Scratch Map</p></a></li>
                    <li><a href="Blog/Blog.php"><img alt="Travel Blog" src="images/blog_nav.png" /> <p>Travel Blog</p></a></li>
                    <li><a href="myTrips.php"><img alt="Your Trips" src="images/trip_nav.png"   /> <p>My Trips</p></a></li>
                    <li><a href="groupMaintance.php"><img alt="Groups" src="images/group_nav.png"  /> <p>My Groups</p></a></li>
                    <li><a href="View_UserProfile.php"><img alt="View Profile" src="images/profile_nav.png" /> <p>View Profile</p></a></li>
		    <li><a onclick="signOut();"><img alt="Logout" src="images/logout_nav.png" /> <p>Logout</p></a></li>	
                </ul>
            </nav>
</div>


<script>
    function init() {
      gapi.load('auth2', function() {
         gapi.auth2.init({
        clientId: "212748848744-vr854thj6aem89gqt2l7nm9ahfprqt10.apps.googleusercontent.com",
        scope: "https://cgi.luddy.indiana.edu/~sydcarpe/capstone-individual/Travelify/"
         }); 
        /* Ready. Make a call to gapi.auth2.init or some other API */
      });
    }

  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
      location.href="homePage.html";
    });
  }

</script>
